<script>
  import { bus } from '../main';
  import { Line } from 'vue-chartjs'

  export default {
    extends: Line,
    data () {
      return {
        car_prices: [1, 5, 3, 8],
        chartData: {
          labels: ["2020 год", "2022 год", "2023 год", "2024 год"],
          datasets: [
            {
              label: 'Себестоимость',
              data: [1, 3, 8, 4],
              fill: false,
              borderColor: '#2554FF',
              backgroundColor: '#2554FF',
              borderWidth: 1
            }
          ]
        },
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
    created() {
      bus.$on('car_response_1[0]', data => {
        this.car_prices[0] = data;
      })
      bus.$on('car_response_1[1]', data => {
        this.car_prices[1] = data;
      })
      bus.$on('car_response_1[2]', data => {
        this.car_prices[2] = data;
      })
      bus.$on('car_response_1[3]', data => {
        this.car_prices[3] = data;
      })
    },
    mounted () {
      this.renderChart(this.chartData, this.options)
    }
  }
</script>