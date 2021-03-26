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
        markers: []
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
      this.$getLocation({})
        .then(coordinates => {
          this.coordinates = coordinates;
        })
        //.catch(error => alert(error));
    },
    methods: {
      onMapClick(e) {
        if (this.marker_description_type_1 == true) {
          this.markers.push({
            //icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
            id: 1 + Math.max(0, ...this.markers.map(n => n.id)),
            position: e.latLng,
            infoText: this.map_year_1 + ' год ' + this.map_number_1 + ' ' + this.map_month_1 + ' - ' + this.marker_description_1
          });
        } else {
          this.markers.push({
            id: 1 + Math.max(0, ...this.markers.map(n => n.id)),
            position: e.latLng,
            infoText: ''
          });
        }
        this.marker_description_type_1 = false
      },
      onMarkerClick(e) {
        this.$refs.map.panTo(e.latLng);
      },
      toggleInfoWindow: function(marker, idx) {
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
    }
  }
</script>
