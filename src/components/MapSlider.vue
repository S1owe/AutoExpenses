<template>
  <swiper class="swiper" :options="swiperOption">
    <swiper-slide>
      <div class="map-page__interface-item">
        <h2>Пенза</h2>
        <p>1-10 сентября</p>
      </div>
    </swiper-slide>
    <swiper-slide>
      <div class="map-page__interface-item">
        <h2>Пенза</h2>
        <p>1-10 сентября</p>
      </div>
    </swiper-slide>
    <swiper-slide>
      <div class="map-page__interface-item">
        <h2>Пенза</h2>
        <p>1-10 сентября</p>
      </div>
    </swiper-slide>
    <swiper-slide>
      <div class="map-page__interface-item">
        <h2>Пенза</h2>
        <p>1-10 сентября</p>
      </div>
    </swiper-slide>
    <swiper-slide>
      <div class="map-page__interface-item">
        <h2>Пенза</h2>
        <p>1-10 сентября</p>
      </div>
    </swiper-slide>
    <swiper-slide>
      <div class="map-page__interface-item">
        <h2>Пенза</h2>
        <p>1-10 сентября</p>
      </div>
    </swiper-slide>
    <swiper-slide>
      <div class="map-page__interface-item">
        <h2>Пенза</h2>
        <p>1-10 сентября</p>
      </div>
    </swiper-slide>
    <swiper-slide>
      <div class="map-page__interface-item">
        <h2>Пенза</h2>
        <p>1-10 сентября</p>
      </div>
    </swiper-slide>
    <swiper-slide>
      <div class="map-page__interface-item">
        <h2>Пенза</h2>
        <p>1-10 сентября</p>
      </div>
    </swiper-slide>
    <div class="swiper-pagination" slot="pagination"></div>
  </swiper>
</template>
<style>
  .swiper-slide {margin-right: -70px;}
</style>
<script>
  import { Swiper, SwiperSlide } from 'vue-awesome-swiper'
  import 'swiper/swiper-bundle.css'

  export default {
    name: 'swiper-example-multiple-slides-per-biew',
    title: 'Multiple slides per view',
    components: {
      Swiper,
      SwiperSlide
    },
    data() {
      return {
        swiperOption: {
          slidesPerView: 6,
          spaceBetween: 10,
          mousewheel: true,
          pagination: {
            el: '.swiper-pagination',
            clickable: true
          }
        }
      }
    }
  }
</script>
