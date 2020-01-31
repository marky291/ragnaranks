<script>
    //Importing Line class from the vue-chartjs wrapper
    import { Bar } from 'vue-chartjs'

    //Exporting this so it can be used in other components
    export default {
        extends: Bar,
        props: ['url'],
        data () {
            return {
                datacollection: {
                    //Data to be represented on x-axis
                    labels: [],
                    datasets: [
                        {
                            label: 'Total Clicks',
                            backgroundColor: '#7fb357',
                            pointBackgroundColor: 'white',
                            lineTension: 0.5,
                            fill: false,
                            pointBorderColor: '#7fb357',
                            data: []
                        }
                    ]
                },
                //Chart.js options that controls the appearance of the chart
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            gridLines: {
                                display: true
                            }
                        }],
                        xAxes: [ {
                            gridLines: {
                                display: true
                            }
                        }]
                    },
                    legend: {
                        display: true
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            }
        },
        async mounted () {
            await axios.get(this.url).then((response) => {
                for(let key in response.data) {
                    this.datacollection.labels.push(key);
                    this.datacollection.datasets[0].data.push(response.data[key]);
                }
                this.renderChart(this.datacollection, this.options)
            });
        }
    }
</script>
