<script>
  import { Bar } from 'vue-chartjs'

  export default {
    extends: Bar,
    data() {
      return {
        chartData: {
          labels: ["2021-01", "2021-02", "2021-03", "2021-04", "2021-05", "2021-06", "2021-07", "2021-08", "2021-09",
            "2021-10", "2021-11", "2021-12"
          ],
          datasets: [{
            label: 'Bar Chart',
            borderWidth: 1,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            data: [50, 25, 3, 65, 56, 9, 12, 65, 76, 81, 13, 100]
          }]
        },
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
            xAxes: [{
              ticks: {
                display: false
              },
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
    mounted() {
      this.renderChart(this.chartData, this.options)
    }
  }
</script>