/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.php",
    "./inc/**/*.php", // Asegura que escanee el Walker
    "./assets/**/*.js",
    "./assets/**/*.jsx",
  ],

  // ¡IMPORTANTE! Esta lista 'safelist' fuerza a Tailwind a crear
  // las clases que el Walker de PHP usa dinámicamente.
  // Esto soluciona el problema de que el menú no se hace visible.
safelist: [
    'group-hover:opacity-100',
    'group-hover:visible',
    'group-hover:z-50',
    'opacity-0',
    'opacity-100', 
    'invisible',
    'z-50',
    'max-h-0',
    'max-h-96',
    'max-h-screen',
    'rotate-180',
    'space-y-2',
    'mt-2',
    'px-4',
    'py-0',      
    'py-2',
    'rounded-md',
    'border',     
    'border-gray-200', 
    'shadow-sm',   
],

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
        // Añadí el color que usa el Walker de resaltado
        "#A13E18": "#A13E18",
      },
      // Añadimos 'max-h-96' para la animación del acordeón
      maxHeight: {
        96: "24rem", // 384px.
      },
    },
  },
  plugins: [],
};
