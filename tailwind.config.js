module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/js/**/*.{jsx,tsx}",
        "./resources/views/**/*.blade.php",
    ],
    theme: {
        extend: {},
        screens: {
            tablet: "500px",
            laptop: "760px",
            desktop: "1024px",
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
