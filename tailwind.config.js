const _ = require("lodash");
const theme = require('./theme.json');
const tailpress = require("@jeffreyvr/tailwindcss-tailpress");

module.exports = {
    mode: 'jit',
    content: [
        './*/*.php',
        './**/*.php',
        './resources/css/*.css',
        './resources/js/*.js',
        './safelist.txt'
    ],
    theme: {
        container: {
            padding: {
                DEFAULT: '1rem',
                sm: '2rem',
                lg: '0rem'
            },
        },
        extend: {
            colors: tailpress.colorMapper(tailpress.theme('settings.color.palette', theme))
        },
        screens: {
            'sm': '640px',
            'md': '768px',
            'lg': '1024px',
            'xl': tailpress.theme('settings.layout.wideSize', theme)
        },
        fontFamily: {
          'sans': 'Orkney',
          'serif': 'Orkney'
        },
        fontSize: {
          'small': '16px',
          'base': '18px',
          'lg': '21px',
          'xl': ['25px', {
            lineHeight: '35px',
          }],
          '2xl': ['31px', {
            lineHeight: '43.4px',
          }],
          '3xl': ['38px', {
            lineHeight: '53.2px',
          }],
          '4xl': ['48px', {
            lineHeight: '67.2px',
          }],
        },
        container: {
          padding: {
            DEFAULT: '1rem',
            sm: '2rem',
          },
          // default breakpoints but with 40px removed
          screens: {
            sm: '600px',
            md: '728px',
            lg: '984px',
            xl: '1240px',
            '2xl': '1496px',
          },
        }
    },
    plugins: [
        tailpress.tailwind
    ]
};
