<?php

$finder = PhpCsFixer\Finder::create()
                           ->exclude(['vendor'])
                           ->in(__DIR__);

return PhpCsFixer\Config::create()
                        ->setRiskyAllowed(true)
                        ->setRules([
                            // The Symfony ruleset is a superset of the PSR2 ruleset, which is a superset of PSR1
                            // Details of what is enabled by @Symfony are in PHP-CS-Fixer/src/RuleSet.php
                            '@Symfony'       => true,
                            '@Symfony:risky' => false,

                            // Things from @Symfony that are overridden
                            'binary_operator_spaces' => [
                                'align_double_arrow' => true,
                                'align_equals'       => true,
                            ],
                            'concat_space' => ['spacing' => 'one'],

                            // Things that are not part of @Symfony and also not marked "risky"
                            'array_syntax'                              => ['syntax' => 'short'],
                            'class_keyword_remove'                      => false, // Disabled because not considered a problem.
                            'combine_consecutive_unsets'                => true,
                            'general_phpdoc_annotation_remove'          => true,
                            'no_multiline_whitespace_before_semicolons' => true,
                            'no_short_echo_tag'                         => true,
                            'no_useless_else'                           => true,
                            'no_useless_return'                         => true,
                            'not_operator_with_space'                   => true,
                            'ordered_class_elements'                    => true,
                            'ordered_imports'                           => true,
                            'phpdoc_add_missing_param_annotation'       => true,
                            'phpdoc_order'                              => true,
                            'protected_to_private'                      => false, // Disabled because not considered a problem.
                            'semicolon_after_instruction'               => true,
                            'yoda_style'                                => false,
                            'phpdoc_no_empty_return'                    => false,
                        ])
                        ->setUsingCache(true)
                        ->setCacheFile(__DIR__ . '/.php_cs.cache')
                        ->setFinder($finder);
