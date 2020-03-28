<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
;

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@PhpCsFixer' => true,
        '@PhpCsFixer:risky' => true,
        'declare_strict_types' => true,
        'yoda_style' => false,
    ])
    ->setFinder($finder)
;
