/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        fontFamily: {
            sans: ["Rubik", "Helvetica", "ui-sans-serif", "system-ui"],
            mono: ["Chivo Mono", "monospace"],
        },

        extend: {
            colors: {
                green: {
                    DEFAULT: "hsl(105deg 100% 55%)",
                },
            },

            spacing: {
                header: "106px",
                footer: "81px",
            },
        },

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
    plugins: [
        require("flowbite/plugin"),
        require("flowbite-typography"),
        require("tailwindcss-container-bleed"),
    ],
};
