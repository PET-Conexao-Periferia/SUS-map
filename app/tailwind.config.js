/** @type {import('tailwindcss').Config} */
export default {
  prefix: 'tw-',
  // include the actual source directory used in this project (app/)
  content: [
    './app/**/*.{vue,js,ts,html,scss}',
    './app/**/**/*.{vue,js,ts,html,scss}',
    './public/**/*.html',
  ],
  theme: {
    extend: {},
    screens: {
      sm: '640px',
      md: '768px',
      lg: '1024px',
      xl: '1280px',
      '2xl': '1536px',
    },
  },
  plugins: [],
}

