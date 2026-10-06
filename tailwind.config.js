/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
        "./vendor/blade-ui-kit/blade-heroicons/resources/**/*.svg",
    ],
    theme: {
        extend: {
            colors: {
                cream: "#FFFBF1",
                sunny: "#FFF2D0",
                blush: "#FFB2B2",
                coral: {
                    DEFAULT: "#E36A6A",
                    dark: "#C94F4F",
                },
                ink: "#3B1F1F",
            },
            fontFamily: {
                sans: [
                    "ui-sans-serif",
                    "system-ui",
                    "-apple-system",
                    "Segoe UI",
                    "Roboto",
                    "Helvetica Neue",
                    "Arial",
                    "sans-serif",
                ],
            },
        },
    },
    plugins: [],
};
