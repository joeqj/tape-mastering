/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {},

        container: {
            center: true,
            padding: {
                DEFAULT: "1rem",
                sm: "1rem",
                md: "1rem",
                lg: "10rem",
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
