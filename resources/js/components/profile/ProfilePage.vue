<script>
    export default {
        props: ['slug'],
        data: function () {
            return {
                listing: {},
                profileLoaded: false,
            }
        },
        mounted() {
            axios.get('/api/listing/'+(this.slug)).then(response => {
                this.listing = response.data;
                this.profileLoaded = true;
            });
        }
    }
</script>