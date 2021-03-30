<template>
    <line-chart :chart-data="datacollection, options" :height="100"></line-chart>
</template>
<script>
  import { bus } from '../main';
  import LineChart from './LineChart2.js'
  export default {
    components: {
      LineChart
    },
    data () {
      return {
        yan_get: '',
        fev_get: '',
        mar_get: '',
        apr_get: '',
        mai_get: '',
        yun_get: '',
        yul_get: '',
        avg_get: '',
        sen_get: '',
        okt_get: '',
        noy_get: '',
        dek_get: '',
        datacollection: null,
        options: {
          scales: {
            yAxes: [{
              ticks: {
                display: false
              },
              gridLines: {
                display: false
              }
            }],
            xAxes: [ {
              gridLines: {
                display: false
              },
              ticks: {
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
          labels: ["Январь", "Февраль", "Март", "Апрель","Май", "Июнь", "Июль", "Август","Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
          datasets: [
            {
              label: 'Количество меток',
              borderWidth: 1,
              backgroundColor: 'rgba(54, 162, 235, 0.2)',
              data: [null, null, null, null, null, null, null, null, null, null, null, null]
            }
          ]
        },
        this.datacollection.datasets[0].data[0] = this.yan_get,
        this.datacollection.datasets[0].data[1] = this.fev_get,
        this.datacollection.datasets[0].data[2] = this.mar_get,
        this.datacollection.datasets[0].data[3] = this.apr_get,
        this.datacollection.datasets[0].data[4] = this.mai_get,
        this.datacollection.datasets[0].data[5] = this.yun_get,
        this.datacollection.datasets[0].data[6] = this.yul_get,
        this.datacollection.datasets[0].data[7] = this.avg_get,
        this.datacollection.datasets[0].data[8] = this.sen_get,
        this.datacollection.datasets[0].data[9] = this.okt_get,
        this.datacollection.datasets[0].data[10] = this.noy_get,
        this.datacollection.datasets[0].data[11] = this.dek_get
      }
    },
    created() {
      bus.$on('yan', data => {
        this.yan_get = data,
        this.fillData()
      }),
      bus.$on('fev', data => {
        this.fev_get = data,
        this.fillData()
      }),
      bus.$on('mar', data => {
        this.mar_get = data,
        this.fillData()
      }),
      bus.$on('apr', data => {
        this.apr_get = data,
        this.fillData()
      }),
      bus.$on('mai', data => {
        this.mai_get = data,
        this.fillData()
      }),
      bus.$on('yun', data => {
        this.yun_get = data,
        this.fillData()
      }),
      bus.$on('yul', data => {
        this.yul_get = data,
        this.fillData()
      }),
      bus.$on('avg', data => {
        this.avg_get = data,
        this.fillData()
      }),
      bus.$on('sen', data => {
        this.sen_get = data,
        this.fillData()
      }),
      bus.$on('okt', data => {
        this.okt_get = data,
        this.fillData()
      }),
      bus.$on('noy', data => {
        this.noy_get = data,
        this.fillData()
      }),
      bus.$on('dek', data => {
        this.dek_get = data,
        this.fillData()
      })
    }
  }
</script>