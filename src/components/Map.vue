<template>
  <div>
    <gmap-map 
      :center="{lat:10, lng: 10}"
      :zoom="7"
      :options="{
        zoomControl: false,
          mapTypeControl: false,
          scaleControl: false,
          streetViewControl: false,
          rotateControl: false,
          fullscreenControl: false,
          disableDefaultUi: false
      }"
      style="width: 100%; height: calc(100vh - 130px);"
      ref="map"
      @click="onMapClick"
    >
    <gmap-cluster>
      <gmap-marker
        :key="i" 
        v-for="(m,i) in markers" 
        :position="m.position" 
        :clickable="true" 
        @click="toggleInfoWindow(m,i)"
        v-on:click="onMarkerClick"
      />
      <gmap-info-window
        :options="infoOptions" 
        :position="infoWindowPos" 
        :opened="infoWinOpen" 
        @closeclick="infoWinOpen=false">
      </gmap-info-window>
    </gmap-cluster>
    </gmap-map>
  </div>
</template>
<script>
  import { bus } from '../main';

  export default {
    data() {
      return {
        coordinates: {
          lat: 0,
          lng: 0
        },
        infoWindowPos: null,
        infoWinOpen: false,
        currentMidx: null,
        infoOptions: {
          content: '',
          pixelOffset: {
            width: 0,
            height: -35
          }
        },
        marker_description_1: '',
        map_year_1: '',
        map_number_1: '',
        map_month_1: '',
        marker_description_type_1: '',
        markers: [],
        marker_id: '',
        marker_id_delete: '',

        yan: 0,
        fev: 0,
        mar: 0,
        apr: 0,
        mai: 0,
        yun: 0,
        yul: 0,
        avg: 0,
        sen: 0,
        okt: 0,
        noy: 0,
        dek: 0
      }
    },
    created() {
      bus.$on('marker_description', data => {
        this.marker_description_1 = data;
      })
      bus.$on('map_year', data => {
        this.map_year_1 = data;
      })
      bus.$on('map_number', data => {
        this.map_number_1 = data;
      })
      bus.$on('map_month', data => {
        this.map_month_1 = data;
      })
      bus.$on('marker_description_type', data => {
        this.marker_description_type_1 = true;
      })
      bus.$on('marker_interface_id', data => {
        this.marker_id = data;
      })
      bus.$on('marker_delete', data => {
        this.marker_id_delete = data;
        this.markers.splice(this.marker_id_delete, 1);
        const parsed = JSON.stringify(this.markers);
        localStorage.setItem('markers', parsed);
      })
      this.$getLocation({})
        .then(coordinates => {
          this.coordinates = coordinates;
        })
        //.catch(error => alert(error));
    },
    methods: {
      onMapClick(e) {
        bus.$emit('marker-interface-add');
        if (this.marker_description_type_1 == true) {
          this.markers.push({
            id: this.marker_id,
            position: e.latLng,
            infoText: this.map_year_1 + ' год ' + this.map_number_1 + ' ' + this.map_month_1 + ' - ' + this.marker_description_1,
          });

          const parsed = JSON.stringify(this.markers);
          localStorage.setItem('markers', parsed);

          if(this.map_month_1 == 'Января') {
            this.yan = this.yan + 1
            bus.$emit('yan', this.yan);
          }
          if(this.map_month_1 == 'Февраля') {
            this.fev = this.fev + 1
            bus.$emit('fev', this.fev);
          }
          if(this.map_month_1 == 'Марта') {
            this.mar = this.mar + 1
            bus.$emit('mar', this.mar);
          }
          if(this.map_month_1 == 'Апреля') {
            this.apr = this.apr + 1
            bus.$emit('apr', this.apr);
          }
          if(this.map_month_1 == 'Мая') {
            this.mai = this.mai + 1
            bus.$emit('mai', this.mai);
          }
          if(this.map_month_1 == 'Июня') {
            this.yun = this.yun + 1
            bus.$emit('yun', this.yun);
          }
          if(this.map_month_1 == 'Июля') {
            this.yul = this.yul + 1
            bus.$emit('yul', this.yul);
          }
          if(this.map_month_1 == 'Августа') {
            this.avg = this.avg + 1
            bus.$emit('avg', this.avg);
          }
          if(this.map_month_1 == 'Сентября') {
            this.sen = this.sen + 1
            bus.$emit('sen', this.sen);
          }
          if(this.map_month_1 == 'Октября') {
            this.okt = this.okt + 1
            bus.$emit('okt', this.okt);
          }
          if(this.map_month_1 == 'Ноября') {
            this.noy = this.noy + 1
            bus.$emit('noy', this.noy);
          }
          if(this.map_month_1 == 'Декабря') {
            this.dek = this.dek + 1
            bus.$emit('dek', this.dek);
          }
        } else {
          this.markers.push({
            id: this.marker_id,
            position: e.latLng,
            infoText: ''
          });

          const parsed = JSON.stringify(this.markers);
          localStorage.setItem('markers', parsed);
        }
        this.marker_description_type_1 = false
      },
      onMarkerClick(e) {
        this.$refs.map.panTo(e.latLng);
      },
      toggleInfoWindow: function(marker, idx) {
        console.log(this.markers.indexOf(marker))
        if (marker.infoText != '') {
          this.infoWindowPos = marker.position;
          this.infoOptions.content = marker.infoText;
          if (this.currentMidx == idx) {
            this.infoWinOpen = !this.infoWinOpen;
          }
          else {
            this.infoWinOpen = true;
            this.currentMidx = idx;
          }
        }
      }
    },
    mounted() {
      if (localStorage.getItem('markers')) {
        try {
          this.markers = JSON.parse(localStorage.getItem('markers'));
        } catch(e) {
          localStorage.removeItem('markers');
        }
      }
    }
  }
</script>
