module.exports = {
    parser: 'vue-eslint-parser',
    parserOptions: {
        parser: '@typescript-eslint/parser',
    },
    plugins: [
        '@typescript-eslint',
    ],
    extends: [
        // 'eslint:recommended',
        'plugin:vue/recommended',
        'plugin:@typescript-eslint/recommended',
        'plugin:import/typescript',
    ],
    rules: {
        'prefer-const': 'off',
        // Generic Javascript Rules
        'space-before-blocks': [
            'error',
            'always',
        ],
        semi: 'error',
        quotes: [
            'warn',
            'single',
            {
                allowTemplateLiterals: true,
            },
        ],
        'quote-props': [
            'error',
            'as-needed',
        ],
        'comma-dangle': [
            'warn',
            'always-multiline',
        ],
        'no-trailing-spaces': 'warn',
        'no-console': 'off',
        'no-multiple-empty-lines': [
            'error',
            {
                max: 1,
                maxEOF: 1,
            },
        ],
        'arrow-parens': [
            'error',
            'as-needed',
        ],
        'no-var': 'error',
        'key-spacing': [
            'error',
            {
                afterColon: true,
            },
        ],
        'object-curly-newline': [
            'warn',
            {
                minProperties: 1,
            },
        ],
        'object-curly-spacing': [
            'warn',
            'always',
        ],
        'template-curly-spacing': 'off',
        'brace-style': [
            'warn',
            'stroustrup',
            {
                allowSingleLine: true,
            },
        ],
        indent: [
            'warn',
            4,
            {
                SwitchCase: 1,
                VariableDeclarator: 1,
            },
        ],
        'object-property-newline': [
            'warn',
            {
                allowAllPropertiesOnSameLine: false,
            },
        ],
        'no-floating-decimal': 'error',
        'arrow-spacing': [
            'error',
            {
                before: true,
                after: true,
            },
        ],
        'comma-spacing': [
            'error',
            {
                before: false,
                after: true,
            },
        ],
        'array-element-newline': [
            'error',
            {
                minItems: 1,
            },
        ],
        'array-bracket-newline': [
            'error',
            {
                minItems: 1,
            },
        ],
        // Vue Rules
        'vue/prop-name-casing': 'off',
        'vue/html-self-closing': 'off',
        'vue/html-indent': [
            'warn',
            4,
            {
                attribute: 1,
                baseIndent: 1,
                closeBracket: 0,
                alignAttributesVertically: true,
            },
        ],
        'vue/max-attributes-per-line': [
            'warn',
            {
                singleline: {
                    max: 1
                },
                multiline: {
                    max: 1
                }
            }
        ],
        'vue/html-closing-bracket-newline': [
            'warn',
            {
                singleline: 'never',
                multiline: 'never',
            },
        ],
        'vue/no-v-html': 'off',
        'vue/attributes-order': 'warn',
        'vue/singleline-html-element-content-newline': 'off',
        // Typescript rules
        '@typescript-eslint/no-var-requires': 'off',
        '@typescript-eslint/no-empty-function': 'off',
        '@typescript-eslint/explicit-module-boundary-types': 'off',        
    },
};
