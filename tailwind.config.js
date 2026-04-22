import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                "background": "#0a0b0f",
                "surface": "#111318",
                "surface-container": "#1a1d24",
                "surface-container-low": "#15181e",
                "surface-container-high": "#1e222a",
                "surface-container-highest": "#262a35",
                "on-surface": "#e2e8f0",
                "on-surface-variant": "#94a3b8",
                "primary": "#00d4aa",
                "primary-container": "#009a7b",
                "on-primary-container": "#ccfbf1",
                "secondary": "#ffd32a",
                "tertiary": "#ff4757",
                "error": "#ff4757",
                "outline": "#475569",
                "outline-variant": "#334155",
            },
            fontFamily: {
                sans: ['"JetBrains Mono"', ...defaultTheme.fontFamily.sans],
                headline: ['"JetBrains Mono"', ...defaultTheme.fontFamily.sans],
                body: ['"JetBrains Mono"', ...defaultTheme.fontFamily.sans],
                label: ['"JetBrains Mono"', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
