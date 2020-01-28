<script>
    //Importing Line class from the vue-chartjs wrapper
    import { Line } from 'vue-chartjs'

    //Exporting this so it can be used in other components
    export default {
        extends: Line,
        props: ['url'],
        data () {
            return {
                datacollection: {
                    //Data to be represented on x-axis
                    labels: [],
                    datasets: [
                        {
                            label: 'Population Today',
                            backgroundColor: '#ff6f56',
                            pointBackgroundColor: 'white',
                            borderWidth: 3,
                            lineTension: 0.5,
                            fill: false,
                            borderColor: '#ff6f56',
                            pointBorderColor: '#e42312',
                            data: []
                        },
                        {
                            label: 'Population Yesterday',
                            backgroundColor: '#aaaaaa',
                            pointBackgroundColor: 'white',
                            borderWidth: 3,
                            lineTension: 0.5,
                            fill: false,
                            borderColor: '#e1e1e1',
                            pointBorderColor: '#e1e1e1',
                            data: []
                        }
                    ]
                },
                //Chart.js options that controls the appearance of the chart
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: false
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
                for(let key in response.data['yesterday']) {
                    this.datacollection.labels.push(key);
                    this.datacollection.datasets[1].data.push(response.data['yesterday'][key]);
                }
                for(let key in response.data['today']) {
                    // this.datacollection.labels.push(key);
                    this.datacollection.datasets[0].data.push(response.data['today'][key]);
                }
                this.renderChart(this.datacollection, this.options)
            });
        }
    }
</script>
