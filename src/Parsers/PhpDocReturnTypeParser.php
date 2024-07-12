<?php

declare(strict_types=1);

namespace Barryvdh\LaravelIdeHelper\Parsers;

class PhpDocReturnTypeParser
{
    /**
     * @var string
     */
    private string $typeAlias;

    /**
     * @var array
     */
    private array $namespaceAliases;

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
    public function parse(): string|null
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
    private function parseTemplate(string|null $template): string
    {
        if ($template  === null || $template === '') {
            return '';
        }

        $type = '';
        $result = '';

        foreach (str_split($template) as $char) {
            $match = preg_match('/[A-z]/', $char);

            if (!$match) {
                $type = $this->namespaceAliases[$type] ?? $type;
                $result .= $type;
                $result .= $char;
                $type = '';

                continue;
            }

            $type .= $char;
        }

        return $result;
    }
}
