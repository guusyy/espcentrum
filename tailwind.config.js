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
            'xl': tailpress.theme('settings.layout.wideSize', theme),
            '2xl': '1600px'
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
            sm: '640px',
            md: '768px',
            lg: '768px',
            xl: '780px',
          },
        }
    },
    plugins: [
        tailpress.tailwind,
        require('@tailwindcss/typography'),
        ({ addComponents, theme }) => {
          addComponents({
            ".container-xl": {
              marginInline: "auto",
              paddingInline: theme("spacing.4"),
              maxWidth: theme("screens.sm"),
    
              // Breakpoints
              "@screen sm": {
                maxWidth: theme("screens.sm"),
                paddingInline: '2rem',
              },
              "@screen md": {
                maxWidth: theme("screens.md"),
                paddingInline: '1.5rem',
              },
              "@screen lg": {
                maxWidth: theme("screens.lg"),
                paddingInline: '1rem',
              },
              "@screen xl": {
                maxWidth: '1180px',
              },
              "@screen 2xl": {
                maxWidth: '1180px',
              }
            },
          });
        },
    ]
};
