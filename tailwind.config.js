const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
            black: '#000000',
            white: '#ffffff',
            ciano: '#00ffff',
            back: '#fffff2',
            backGreen: '#93dddc',
            backDarkGreen: '#143c3c',
            iconColor: '#666666',
            botaoAzul: '#BFFFFE',
        }
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};