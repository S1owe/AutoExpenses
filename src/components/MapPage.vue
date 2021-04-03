<template>
	<div style="overflow-x:hidden;">
    <div class="messager_block" v-if="message_block_status == 1">
      <Messager/>
    </div>
    <div class="connect_title_interface" @click="message_block_status = message_block_status * -1">
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
      	<div class="map-page__suptitle" v-on:click="checkk">
        		<p>В хронологии на Google Картах вы можете посмотреть свои маршруты, а также места, в которых вы побывали. Это приблизительная информация, которая определяется на основе истории местоположений. Вы также можете изменить или удалить информацию в хронологии. Ваша хронология видна только вам и доступна как на мобильных устройствах, так и на компьютере.</p>
      	</div>
      	<div class="map-page__main">
        		<div class="map-menu">
          		<MapMenu/>
        		</div>
        		<div class="map">
          		<Map/>
              <div class="marker-description-window" v-if="marker_description_window_type == 1">
                <div class="marker-description-close" v-on:click="marker_description_window_open">
                  <img src="https://img.icons8.com/fluent-systems-regular/40/000000/close-window.png"/>
                </div>
                <h5>Заметка</h5>
                <p>{{ marker_description }}</p>
              </div>
        		</div>
      	</div>
      	<div class="map-page__interface">
          <swiper class="swiper" :options="swiperOption">
              <swiper-slide v-for='(item, index) in items' key='index'>
                <div class="map-page__interface-item" @click="marker_description = item.description" v-on:click="marker_description_window_open(item, index)">
                  <div class="marker-title">
                    {{ item.title }}
                  </div>
                  <div class="marker-date">
                    {{ item.date }}
                  </div>
                  <div class="marker-description" v-if="item.description != undefined">
                    Нажмите, чтобы просмотреть заметку
                  </div>
                  <div class="marker-delete" @click="marker_delete_index = item.id" v-on:click="marker_delete(item, index)">
                    <div @click="marker_description = item.description">
                      <img src="https://img.icons8.com/ios-glyphs/30/000000/close-window.png"/> 
                    </div>
                  </div>
                </div>
              </swiper-slide>
          </swiper>
      	</div>
        <Footer/>
      </div>
    </div>
</template>
<script>
  import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
  import 'swiper/swiper-bundle.css'

  import { bus } from '../main';

	import Map from './Map'
	import MapMenu from './MapMenu'
	import MapMenuChart from './MapMenuChart'
  import Header from './Header'
  import Footer from './Footer'
  import Messager from './Messager'

  import axios from 'axios';
	export default {
		components: {
			Map,
			MapMenu,
			MapMenuChart,
      Header,
      Footer,
      Messager,
      Swiper,
      SwiperSlide
		},
    data() {
      return {
        items: [],
        description_marker_type_get: '',
        marker_number: '',
        marker_month: '',
        marker_year: '',
        marker_interface_id: -1,
        marker_delete_index: '',
        marker_description_get: '',
        marker_description: '',
        marker_description_window_type: -1,
        message_block_status: -1,
        checkkk: '',
        swiperOption: {
          slidesPerView: 5,
          spaceBetween: 30,
          calculateHeight: false,
          mousewheel: true,
          pagination: {
            el: '.swiper-pagination',
            clickable: true
          }
        }
      }
    },
    methods: {
      addNewItem() {
        this.marker_interface_id = this.marker_interface_id + 1,
        this.items.push({
          title: 'Метка ' + this.marker_interface_id,
          id: this.marker_interface_id
        });
        bus.$emit('marker_interface_id', this.marker_interface_id);
        const parsed = JSON.stringify(this.items);
        localStorage.setItem('items', parsed);
      },
      addNewItemDesc() {
        this.marker_interface_id = this.marker_interface_id + 1,
        this.items.push({
          title: 'Метка ' + this.marker_interface_id,
          date: this.marker_number + ' ' + this.marker_month + ' ' + this.marker_year + ' год',
          description: this.marker_description_get,
          id: this.marker_interface_id
        });
        this.checkkk = this.items[this.items.length-1].description;
        const parsed = JSON.stringify(this.items);
        localStorage.setItem('items', parsed);

      },
      marker_delete(item, index) {
        if(this.marker_description != undefined) {
          this.marker_description_window_type = this.marker_description_window_type * -1
        }
        console.log('Передался индекс на удаление: ' + this.items.indexOf(item))
        bus.$emit('marker_delete', this.items.indexOf(item));
        this.items.splice(index, 1);
        const parsed = JSON.stringify(this.items);
        localStorage.setItem('items', parsed);
      },
      marker_description_window_open() {
        if(this.marker_description != undefined) {
          this.marker_description_window_type = this.marker_description_window_type * -1
        }
      },
      checkk() {
        console.log('hsbefmiwergfihb')
        console.log(this.checkkk)
      }
	  },
    created() {
      bus.$on('marker-interface-add', data => {
        if (this.description_marker_type_get == true) {
          this.addNewItemDesc();
          this.description_marker_type_get = false
        } 
        else {
          this.addNewItem();
        }
      });
      bus.$on('description_marker_type', data => {
        this.description_marker_type_get = data;
      });
      bus.$on('description_marker_date_number', data => {
        this.marker_number = data;
      });
       bus.$on('description_marker_date_month', data => {
        this.marker_month = data;
      });
        bus.$on('description_marker_date_year', data => {
        this.marker_year = data;
      });
        bus.$on('marker_description', data => {
        this.marker_description_get = data;
      });
      bus.$on('messager_title_close', data => {
        this.message_block_status = data;
      });
    },
    mounted() {
      if (localStorage.getItem('items')) {
        try {
          this.items = JSON.parse(localStorage.getItem('items'));
        } catch(e) {
          localStorage.removeItem('items');
        }
      }
    }
  }
</script>
<style scoped>
  .map-description {margin-top: 60px;}
</style>
<style>
  .swiper-wrapper {margin-top: 10px; padding-bottom: 10px;}

  .messager_block {position: fixed; z-index: 5000; top: 50%; left: 50%; transform: translate(-50%, -50%);}
  
  .marker-title {text-align: center; font-family: 'Proxima Nova Rg'; font-weight: bold; font-size: 25px; color: white;}
  .marker-date {text-align: center; font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 20px; color: white;}
  .marker-description {text-align: center; font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 20px; color: white;}
  .marker-delete {position: absolute; top: 0; right: 0;}
  .marker-description-window {width: 250px; height: 300px; background-color: white; position: absolute; top: 30%; right: 10%; border-radius: 5px;}
  .marker-description-window h5 {font-family: 'Proxima Nova Rg'; font-weight: bold; font-size: 30px; color: #0066CC; text-align: center;}
  .marker-description-window p {font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 23px; color: black; text-align: center;}
  .marker-description-close {position: absolute; top: 0; right: 0; cursor: pointer;}

  .map {z-index: 10; position: relative;}
	.map-page__title h1{font-family: 'Proxima Nova Rg'; font-weight: bold; font-size: 48px; color: #0066CC; text-align: center;}
  	.map-page__title {margin-top: 104px;}
 	.map-page__suptitle p{font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 18px; color: #262C40; text-align: justify;}
  	.map-page__suptitle {max-width: 819px; margin: 0 auto; margin-top: 29px; padding-bottom: 67px;}
  	.map-page__interface {height: 130px; width: 100%; background-color: #fafafa; z-index: 1;}
  	.map {position: relative; z-index: 1;}
  	.map-menu {position: absolute; z-index: 20;}
  	.map-page__interface {align-items: center; background-color: #E5E5E5;}
  	.map-page__interface-item {height: 120px; width: 280px; background: url(../assets/map-item-bg.png); height: 110px; cursor: pointer; transition: all 0.1s linear; z-index: 999; box-shadow: 0 0 6px grey; margin-left: 25px; position: relative;}
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