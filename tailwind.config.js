/** @type {import('tailwindcss').Config} */
module.exports = {
    daisyui: {
        themes: [
            {
                default: {
                    "primary": "#661AE6",
                    "secondary": "#D926AA",
                    "accent": "#1FB2A5",
                    "neutral": "#F8FAFC",
                    "base-100": "#f8fafc",
                    "info": "#3ABFF8",
                    "success": "#36D399",
                    "warning": "#FBBD23",
                    "error": "#F87272",
                },
            },
        ],
    },
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    plugins: [require('daisyui')],
}
