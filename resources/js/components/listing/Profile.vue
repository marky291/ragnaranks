<script>
    Vue.component('population-metric-chart', require('./PopulationMetricChart').default);
    Vue.component('monthly-vote-metric-chart', require('./MonthlyVoteMetricChart').default);
    Vue.component('monthly-click-metric-chart', require('./MonthlyClickMetricChart').default);

    export default {
        props: ['trackclick', 'clickcount', 'votecount'],
        data: function () {
            return {
                clicks: this.clickcount,
                votes: this.votecount,
            }
        },
        methods: {
            trackUserClick() {
                axios.post(this.trackclick).then((response) => {
                    this.clicks++;
                }).catch((errors) => {
                    // we dont need to display anything.
                });
            },
        }
    }
</script>
