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
        extend: {
            colors: tailpress.colorMapper(tailpress.theme('settings.color.palette', theme))
        },
        screens: {
            'sm': '640px',
            'md': '768px',
            'lg': '1010px',
            'xl': tailpress.theme('settings.layout.wideSize', theme),
            '2xl': '1600px'
        },
        fontFamily: {
          'sans': 'Karla',
          'serif': 'Karla'
        },
        fontSize: {
          'xs': ['14px', {
            lineHeight: '22px',
          }],
          'small': ['16px', {
            lineHeight: '28px',
          }],
          'base': [
            '18px', {
            lineHeight: '27px',
          }],
          'lg': [
            '21px', {
            lineHeight: '31.5px',
          }],
          'lg2': [
            '22px', {
            lineHeight: '35.2px',
          }],
          'xl': [
            '25px', {
            lineHeight: '35px',
          }],
          'm2xl': [
            '28px', {
              lineHeight: '39.2px',
            }
          ],
          '2xl': [
            '31px', {
            lineHeight: '43.4px',
          }],
          'm3xl': [
            '34px', {
              lineHeight: '50.4px',
            }
          ],
          '3xl': [
            '38px', {
            lineHeight: '53.2px',
          }],
          '4xl': [
            'clamp(1.875rem, 2vw + 1rem, 3.25rem)', {
            lineHeight: 'clamp(2.375rem, 3vw + 1rem, 4rem)',
          }],
          '5xl': [
            'clamp(2rem, 2vw + 1rem, 3.25rem)', {
            lineHeight: '1.3',
          }]
        },
        container: {
          padding: {
            DEFAULT: '1.25rem',
          },
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
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/typography'),
        ({ addComponents, theme }) => {
          addComponents({
            ".container-xl": {
              marginInline: "auto",
              paddingInline: '1.25rem',
              maxWidth: theme("screens.sm"),
    
              // Breakpoints
              "@screen sm": {
                maxWidth: theme("screens.sm"),
              },
              "@screen md": {
                maxWidth: theme("screens.md"),
              },
              "@screen lg": {
                maxWidth: theme("screens.lg"),
              },
              "@screen xl": {
                maxWidth: '1180px',
              },
              "@screen 2xl": {
                maxWidth: '1200px',
              }
            },
            ".container-base": {
              marginInline: "auto",
              paddingInline: '1.25rem',
              maxWidth: theme("screens.sm"),
    
              // Breakpoints
              "@screen sm": {
                maxWidth: theme("screens.sm"),
              },
              "@screen md": {
                maxWidth: theme("screens.md"),
              },
              "@screen lg": {
                maxWidth: theme("screens.lg"),
              },
              "@screen xl": {
                maxWidth: '1180px',
              },
              "@screen 2xl": {
                maxWidth: '1380px',
              }
            },
          });
        },
    ]
};
