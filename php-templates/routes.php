<?php

function vsCodeGetRouterReflection(Illuminate\Routing\Route $route)
{
    if ($route->getActionName() === 'Closure') {
        return new ReflectionFunction($route->getAction()['uses']);
    }

    if (!str_contains($route->getActionName(), '@')) {
        return new ReflectionClass($route->getActionName());
    }

    try {
        return new ReflectionMethod($route->getControllerClass(), $route->getActionMethod());
    } catch (Throwable $e) {
        $namespace = app(Illuminate\Routing\UrlGenerator::class)->getRootControllerNamespace()
            ?? (app()->getNamespace() . 'Http\Controllers');

        return new ReflectionMethod(
            $namespace . '\\' . ltrim($route->getControllerClass(), '\\'),
            $route->getActionMethod(),
        );
    }
}

return collect(app('router')->getRoutes()->getRoutes())
    ->map(function (Illuminate\Routing\Route $route) {
        try {
            $reflection = vsCodeGetRouterReflection($route);
        } catch (Throwable $e) {
            $reflection = null;
        }

        return [
            'method' => collect($route->methods())->filter(function ($method) {
                return $method !== 'HEAD';
            })->implode('|'),
            'uri' => $route->uri(),
            'name' => $route->getName(),
            'action' => $route->getActionName(),
            'parameters' => $route->parameterNames(),
            'filename' => $reflection ? $reflection->getFileName() : null,
            'line' => $reflection ? $reflection->getStartLine() : null,
        ];
    })
;
