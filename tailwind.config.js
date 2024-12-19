module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      fontFamily: {
        noto: ['Noto Sans', 'sans-serif'],
      },
      colors: {
        primary: '#F1C40F',
        secondary: '#34495E',
        accent: '#ECF0F1',
        background: '#3498DB',
      },
    },
  },
  plugins: [
      require('flowbite/plugin')
  ],
}