const defaults = require('tailwindcss/defaultTheme');

module.exports = {
    content: require('fast-glob').sync([
        'source/**/*.html',
        'source/**/*.md',
        'source/**/*.js',
        'source/**/*.php',
        'source/**/*.vue',
    ]),
    options: {
        safelist: [/language/, /hljs/, /mce/],
    },
    theme: {
        container: {
            center: true,
        },
        screens: {
            'sm': '640px',
            'md': '768px',
            'lg': '1024px',
        },
        extend: {
            fontFamily: {
                'sans': [
                    'Montserrat',
                    ...defaults.fontFamily.sans,
                ],
            },
        },
    },
};
