/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');
const plugin = require("tailwindcss/plugin");

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'ryojo-home1':"url('/src/image/25213657_s.jpg')", 
                'ryojo-home2':"url('/src/image/25015918_m.jpg')",
                'ryojo-home3':"url('/src/image/24889706_m.jpg')",//bladeで読み込むからpublic起点でね！詰まった〜〜〜〜〜
            }
        },
    },



    plugins: [require('@tailwindcss/forms'),
        plugin(function ({ addUtilities, addComponents, e, prefix, config }) {
        const newUtilities = {
          ".horizontal-tb": {
            writingMode: "horizontal-tb",
          },
          ".vertical-rl": {
            writingMode: "vertical-rl",
          },
          ".vertical-lr": {
            writingMode: "vertical-lr",
          },
        };
        addUtilities(newUtilities);
      }),
    ],            
};