<script>
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
