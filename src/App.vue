<template>
  <div id="app">
    <router-view/>
  </div>
</template>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.0/vue.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/markerclustererplus/2.1.4/markerclusterer.js"></script>
  <script src="vue-google-maps.js"></script>
<script>
import MapPage from './components/MapPage'
import AuthPage from './components/AuthPage'

export default {
  name: 'App',
  components: {
    MapPage,
    AuthPage
  }
}
</script>

<style>
  
  @font-face {
    font-family: 'Proxima Nova Rg';
    src: url('./assets/fonts/ProximaNova-Bold.eot');
    src: local('Proxima Nova Bold'), local('ProximaNova-Bold'),
      url('./assets/fonts/ProximaNova-Bold.eot?#iefix') format('embedded-opentype'),
      url('./assets/fonts/ProximaNova-Bold.woff') format('woff'),
      url('./assets/fonts/ProximaNova-Bold.ttf') format('truetype');
    font-weight: bold;
    font-style: normal;
  }
    @font-face {
    font-family: 'Proxima Nova Rg';
    src: url('./assets/fonts/ProximaNova-Regular.eot');
    src: local('Proxima Nova Regular'), local('ProximaNova-Regular'),
      url('./assets/fonts/ProximaNova-Regular.eot?#iefix') format('embedded-opentype'),
      url('./assets/fonts/ProximaNova-Regular.woff') format('woff'),
      url('./assets/fonts/ProximaNova-Regular.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
  }
  @font-face {
  font-family: 'Proxima Nova Lt';
  src: url('./assets/fonts/ProximaNova-Semibold.eot');
  src: local('Proxima Nova Semibold'), local('ProximaNova-Semibold'),
    url('./assets/fonts/ProximaNova-Semibold.eot?#iefix') format('embedded-opentype'),
    url('./assets/fonts/ProximaNova-Semibold.woff') format('woff'),
    url('./assets/fonts/ProximaNova-Semibold.ttf') format('truetype');
  font-weight: 600;
  font-style: normal;
}

  * {box-sizing: border-box;}
  body {margin: 0; padding: 0;}
  h1,h2,h3,h4,h5,h6,p {margin: 0; padding: 0;}

  .error_block, .info_block {margin-top: 30px; text-align: center;}

  h2.error_text {font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 19px; color: white; background-color: rgba(220, 20, 60, 0.6);}
  h2.info_text {font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 19px; color: white; background-color: rgba(0, 102, 204, 0.5);}
</style>
