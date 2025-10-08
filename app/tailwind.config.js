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
  },
  plugins: [],
}

