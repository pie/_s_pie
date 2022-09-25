const { defineConfig } = require( '@vue/cli-service' );
console.log('local config');
module.exports = defineConfig({
  transpileDependencies: true,
  filenameHashing: false,
  indexPath: 'index.php',
  publicPath: '/wp-content/themes/_s_pie/dist/',
  chainWebpack: config => {
    config.entry( 'navigation' )
        .add( './src/js/navigation.js' )
        .end()
    config.plugin( 'html' )
      .tap( ( args ) => {
        // eslint-disable-next-line no-param-reassign
        // args[0].excludeChunks = [ 'navigation']
        return args
      })
  }
})