module.exports = {
  plugins: [
    require('postcss-rtlcss')({
      mode: 'combined'
    }),
    require('autoprefixer')
  ]
}
