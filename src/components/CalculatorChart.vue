<template>
  <div class="small">
    <line-chart :chart-data="datacollection, options"></line-chart>
  </div>
</template>
<script>
  import { bus } from '../main';
  import LineChart from './LineChart.js'
  export default {
    components: {
      LineChart
    },
    data () {
      return {
        car_response_1: [],
        car_prices: [],
        datacollection: null,
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              },
              gridLines: {
                display: false
              }
            }],
            xAxes: [ {
              gridLines: {
                display: false
              }
            }]
          },
          legend: {
            display: false
          },
          responsive: true,
          maintainAspectRatio: false
        }
      }
    },
    methods: {
      fillData () {
        console.log("метод вызвался")
        this.datacollection = {
          labels: ["2021", "2022", "2023", "2024"],
          datasets: [
            {
              label: 'Себестоимость',
              fill: false,
              borderColor: '#2554FF',
              backgroundColor: '#2554FF',
              borderWidth: 1,
              data: [null, null, null, null]
            }
          ]
        },
        this.datacollection.datasets[0].data[0] = this.car_prices[0],
        this.datacollection.datasets[0].data[1] = this.car_prices[1],
        this.datacollection.datasets[0].data[2] = this.car_prices[2],
        this.datacollection.datasets[0].data[3] = this.car_prices[3]
      }
    },
    created() {
      bus.$on('car_response', data => {
        this.car_response_1 = data,
        this.car_prices[0] = this.car_response_1[0].price,
        this.car_prices[1] = this.car_response_1[1].price,
        this.car_prices[2] = this.car_response_1[2].price,
        this.car_prices[3] = this.car_response_1[3].price,
        this.fillData()
      })
    },
    mounted () {
      
    }
  }
</script>