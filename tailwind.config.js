/** @type {import('tailwindcss').Config} */
module.exports = {
  daisyui: {
    themes: ['light'],
    //light / winter / emerald / fantasy / lemonade
  },
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    // './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [require("daisyui")],
}
