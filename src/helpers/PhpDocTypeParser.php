<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\helpers;

class PhpDocTypeParser
{
    /**
     * @var string
     */
    private $typeAlias;

    /**
     * @var array
     */
    private $namespaceAliases;

    /**
     * @param string $typeAlias
     * @param array $namespaceAliases
     */
    public function __construct(string $typeAlias, array $namespaceAliases)
    {
        $this->typeAlias = $typeAlias;
        $this->namespaceAliases = $namespaceAliases;
    }

    /**
     * @return string|null
     */
    public function parse()
    {
        $matches = [];
        preg_match('/(\w+)(<.*>)/', $this->typeAlias, $matches);
        $matchCount = count($matches);

        if ($matchCount === 0 || $matchCount === 1) {
            return null;
        }

        if (empty($this->namespaceAliases[$matches[1]])) {
            return null;
        }

        return $this->namespaceAliases[$matches[1]] . $this->parseTemplate($matches[2] ?? null);
    }

    /**
     * @param string|null $template
     * @return string
     */
    private function parseTemplate($template): string
    {
        if (!$template || $template === '') {
            return '';
        }

        $matches = [];
        preg_match_all('/\w+/', $template, $matches);
        $types = array_unique($matches[0]);
        foreach ($types as $type) {
            $typeAlias = $this->namespaceAliases[$type] ?? $type;

            dump($this->namespaceAliases, $typeAlias);
            $template = preg_replace("/\W$type\W/", $typeAlias, $template);
        }

        return $template;
    }
}
