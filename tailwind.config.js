import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            colors: {
                navy: {
                    50: "#f0f4f8",
                    100: "#d9e2ec",
                    200: "#bcccdc",
                    300: "#9fb3c8",
                    400: "#829ab1",
                    500: "#627d98",
                    600: "#486581",
                    700: "#334e68",
                    800: "#243b53",
                    900: "#1e3a5f",
                    950: "#102a43",
                },
                gold: {
                    50: "#fdf9ef",
                    100: "#faf0d7",
                    200: "#f4dead",
                    300: "#edc97a",
                    400: "#e5b04a",
                    500: "#c9a962",
                    600: "#b8974a",
                    700: "#9a7a3d",
                    800: "#7d6238",
                    900: "#665130",
                    950: "#392b18",
                },
            },
            fontFamily: {
                sans: [
                    "Inter",
                    "Source Sans Pro",
                    ...defaultTheme.fontFamily.sans,
                ],
            },
        },
    },

    plugins: [forms],
};
