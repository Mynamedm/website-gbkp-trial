import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    safelist: [
        {
            pattern: /^(bg|text|from|to|border|ring)-(pink|blue|teal|green|violet|amber|rose)-(50|100|300|400|500|600)$/,
            variants: ['hover', 'focus'],
        },
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                '2xs': ['0.65rem', { lineHeight: '1rem' }],
            },
        },
    },

    plugins: [forms],
};
