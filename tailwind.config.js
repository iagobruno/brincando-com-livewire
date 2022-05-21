module.exports = {
    mode: "jit",
    content: [
        "./resources/js/**/*.{jsx,tsx}",
        "./resources/views/**/*.blade.php",
    ],
    theme: {
        extend: {},
        screens: {
            mobile: "500px",
            tablet: "760px",
            desktop: "1024px",
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
