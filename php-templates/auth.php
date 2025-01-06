<?php

return collect(Illuminate\Support\Facades\Gate::abilities())
    ->map(function ($policy, $key) {
        $reflection = new ReflectionFunction($policy);

        $policyClass = null;

        $closureThis = $reflection->getClosureThis();
        if ($closureThis && get_class($closureThis) === Illuminate\Auth\Access\Gate::class) {
            $vars = $reflection->getClosureUsedVariables();

            if (isset($vars['callback'])) {
                [$policyClass, $method] = explode('@', $vars['callback']);

                $reflection = new ReflectionMethod($policyClass, $method);
            }
        }
        return [
            'key' => $key,
            'uri' => $reflection->getFileName(),
            'policy_class' => $policyClass,
            'lineNumber' => $reflection->getStartLine(),
        ];
    })
    ->merge(
        collect(Illuminate\Support\Facades\Gate::policies())->flatMap(function ($policy, $model) {
            $methods = (new ReflectionClass($policy))->getMethods();

            return collect($methods)->map(function (ReflectionMethod $method) use ($policy) {
                return [
                    'key' => $method->getName(),
                    'uri' => $method->getFileName(),
                    'policy_class' => $policy,
                    'lineNumber' => $method->getStartLine(),
                ];
            })->filter(function ($ability) {
                return !in_array($ability['key'], ['allow', 'deny']);
            });
        }),
    )
    ->values()
    ->groupBy('key');
