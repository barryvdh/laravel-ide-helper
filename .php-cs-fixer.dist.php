<?php
require __DIR__ . '/vendor/autoload.php';

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('tests');

$config = require __DIR__ . '/.php-cs-fixer.common.php';

return (new PhpCsFixer\Config())
    ->setFinder($finder)
    ->setRules($config)
    ->setRiskyAllowed(true)
    ->setCacheFile(__DIR__ . '/.php-cs-fixer.cache');
