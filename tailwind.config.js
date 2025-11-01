/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.php", "./assets/**/*.js", "./assets/**/*.jsx"],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Montserrat", "sans-serif"],
        display: ['"Bebas Neue"', "sans-serif"],
      },
      colors: {
        naranja: "#F8A60E",
        negro: "#000000",
        "blanco-gris": "#F5F5F5",
        gris: "#9D9D9D",
      },
    },
  },
  plugins: [],
};
