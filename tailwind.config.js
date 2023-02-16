/** @type {import('tailwindcss').Config} */
module.exports = {
//   daisyui: {
//     themes: ["dark"],
//   },
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
// php -S localhost:8000 -t public
