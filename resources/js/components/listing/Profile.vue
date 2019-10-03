<script>
    export default {
        props: ['trackclick'],
        methods: {
            trackUserClick() {
                axios.post(this.trackclick).then(function(response) {
                    ga('send', 'event', 'Listing', 'clicked', this.listing.name);
                });
            }
        }
    }
</script>
