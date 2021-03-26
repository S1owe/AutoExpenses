<template>
	<div style="overflow-x:hidden;">
    <div class="connect_title_interface">
      <div class="connect-title">
        <h1>Остались вопросы?</h1>
      </div>
      <div class="connect-suptitle">
          <img src="../assets/connect-1.png">
      </div>
    </div>
    <div class="noconnect_title">
        <Header/>
  		  <div class="map-page__title">
        		<h1>Мои путешествия</h1>
      	</div>
      	<div class="map-page__suptitle">
        		<p>В хронологии на Google Картах вы можете посмотреть свои маршруты, а также места, в которых вы побывали. Это приблизительная информация, которая определяется на основе истории местоположений. Вы также можете изменить или удалить информацию в хронологии. Ваша хронология видна только вам и доступна как на мобильных устройствах, так и на компьютере.</p>
      	</div>
      	<div class="map-page__main">
        		<div class="map-menu">
          		<MapMenu/>
        		</div>
        		<div class="map">
          		<Map/>
        		</div>
      	</div>
      	<div class="map-page__interface">
        		<div class="map-page__interface-left">
              <MapSlider/>
          		<!--<div class="map-page__interface-item">
            			<h2>Пенза</h2>
            			<p>1-10 сентября</p>
          		</div>
              <div class="map-page__interface-item">
                  <h2>Пенза</h2>
                  <p>1-10 сентября</p>
              </div>
              <div class="map-page__interface-item">
                  <h2>Пенза</h2>
                  <p>1-10 сентября</p>
              </div>
              <div class="map-page__interface-item">
                  <h2>Пенза</h2>
                  <p>1-10 сентября</p>
              </div>-->
        		</div>
      	</div>
        <Footer/>
      </div>
    </div>
</template>
<script>
  import Slick from 'vue-slick';

	import Map from './Map'
  import MapSlider from './MapSlider'
	import MapMenu from './MapMenu'
	import MapMenuChart from './MapMenuChart'
  import Header from './Header'
  import Footer from './Footer'
	export default {
		components: {
			Map,
			MapMenu,
			MapMenuChart,
      Header,
      Footer,
      Slick,
      MapSlider
		},
    data() {
      return {
        slickOptions: {
            slidesToShow: 10
        }
      }
    }
	}
</script>
<style scoped>
  .map-description {margin-top: 60px;}
</style>
<style>
  .map {z-index: 10;}
	.map-page__title h1{font-family: 'Proxima Nova Rg'; font-weight: bold; font-size: 48px; color: #0066CC; text-align: center;}
  	.map-page__title {margin-top: 104px;}
 	.map-page__suptitle p{font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 18px; color: #262C40; text-align: justify;}
  	.map-page__suptitle {max-width: 819px; margin: 0 auto; margin-top: 29px; padding-bottom: 67px;}
  	.map-page__interface {height: 130px; width: 100%; background-color: #fafafa; margin-bottom: 38px; z-index: 1;}
  	.map {position: relative; z-index: 1;}
  	.map-menu {position: absolute; z-index: 20;}
  	.map-page__interface {display: flex; height: 130px; align-items: center; justify-content: space-between; padding: 0 15px; background-color: #E5E5E5;}
  	.map-page__interface-item {width: 280px; height: 110px; background: url(../assets/map-item-bg.png); height: 110px; cursor: pointer; transition: all 0.1s linear; z-index: 2; box-shadow: 0 0 6px grey;}
  	.map-page__interface-item:hover {transform: scale(1.1);}
  	.map-page__interface-item h2 {font-family: 'Proxima Nova Rg'; font-weight: 600; font-size: 35px; color: white; text-align: center; padding-top: 15px;}
  	.map-page__interface-item p {font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 18px; color: #262C40; text-align: center;}
  	.map-page__interface-left {display: flex;}
  	.connect_title_interface {display: flex; align-items: center; transition: all 0.1s linear; cursor: pointer; z-index: 10; position: fixed; bottom:4%; right: 3%;}
  	.connect_title_interface:hover {transform: scale(1.05);}
  	.connect-title {margin-right: 5px;}
  	.connect-title h1 {font-family: 'Proxima Nova Rg'; font-weight: bold; font-size: 24px; color: #0066CC;}
    .noconnect_title {z-index: 5;}
</style>