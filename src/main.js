import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store/index'
import VueGeolocation from 'vue-browser-geolocation'
import vSelect from 'vue-select'
import {Swiper as SwiperClass, Mousewheel} from 'swiper/core';
SwiperClass.use([Mousewheel]);

Vue.config.productionTip = false
Vue.use(VueGeolocation)

Vue.component('v-select', vSelect)
import 'vue-select/dist/vue-select.css';


import * as VueGoogleMaps from 'vue2-google-maps'
import GmapCluster from 'vue2-google-maps/dist/components/cluster'
Vue.component('GmapCluster', GmapCluster)

Vue.use(VueGoogleMaps, {
	load: {
		key: 'AIzaSyDpsB33a6K_77Tsh4gxpx6hI2xdR_Vg1Jo'
	}
})

export const bus = new Vue();

new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})
