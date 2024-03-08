<?php

// Share common rules between non-test and test files
return [
    '@PSR12' => true,
    'blank_line_after_opening_tag' => true,
    'braces' => [
        'allow_single_line_anonymous_class_with_empty_body' => true,
    ],
    'compact_nullable_typehint' => true,
    'declare_equal_normalize' => true,
    'lowercase_cast' => true,
    'lowercase_static_reference' => true,
    'new_with_braces' => true,
    'no_blank_lines_after_class_opening' => true,
    'no_leading_import_slash' => true,
    'no_whitespace_in_blank_line' => true,
    'ordered_class_elements' => [
        'order' => [
            'use_trait',
        ],
    ],
    'ordered_imports' => [
        'imports_order' => [
            'class',
            'function',
            'const',
        ],
        'sort_algorithm' => 'alpha',
    ],
    'return_type_declaration' => true,
    'short_scalar_cast' => true,
    'single_trait_insert_per_statement' => true,
    'ternary_operator_spaces' => true,
    'visibility_required' => [
        'elements' => [
            'const',
            'method',
            'property',
        ],
    ],

    // Further quality-of-life improvements
    'array_syntax' => [
        'syntax' => 'short',
    ],
    'concat_space' => [
        'spacing' => 'one',
    ],
    'fully_qualified_strict_types' => true,
    'native_function_invocation' => [
        'include' => [],
        'strict' => true,
    ],
    'no_unused_imports' => true,
    'single_quote' => true,
    'space_after_semicolon' => true,
    'trailing_comma_in_multiline' => true,
    'trim_array_spaces' => true,
    'unary_operator_spaces' => true,
    'whitespace_after_comma_in_array' => true,
];
