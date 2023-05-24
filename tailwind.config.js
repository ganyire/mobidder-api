const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.tsx",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                inter: ["Regular"],
                interItalic: ["Italic"],
                interBold: ["Bold"],
                interBoldItalic: ["BoldItalic"],
                interLight: ["Light"],
                interLightItalic: ["LightItalic"],
            },
            colors: ({ colors }) => ({
                primary: "#f9f9f9",
                secondary: colors.slate["800"],
                accent: "#5943be",
                "secondary-alternative": "#fb5f1c",
            }),
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
