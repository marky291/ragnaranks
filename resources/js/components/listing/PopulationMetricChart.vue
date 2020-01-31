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
                    labels: [
                        '12am', '1am', '2am', '3am', '4am', '5am', '6am', '7am', '8am', '9am', '10am', '11am', 
                        '12pm', '1pm', '2pm', '3pm', '4pm', '5pm', '6pm', '7pm', '8pm', '9pm', '10pm', '11pm'
                    ],
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
                for(let key in response.data['today']) {
                    this.datacollection.datasets[0].data.push(response.data['today'][key]);
                }
                for(let key in response.data['yesterday']) {
                    this.datacollection.datasets[1].data.push(response.data['yesterday'][key]);
                }
                this.renderChart(this.datacollection, this.options)
            });
        }
    }
</script>
