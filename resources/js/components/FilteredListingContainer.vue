<script>
    import axios from 'axios';

    export default {

        data: function () {
            return {
                listings: {},
                pagination: {},
            }
        },

        created: function(){
            axios.get('/api/listings').then(response => {
                this.listings = response.data.data;
            });
        },
        methods: {
            visit: function(slug) {
                window.location.href = '/listing/' + slug;
            },
        },
        mounted() {
            this.$root.$on('filter:changed', (param) => {
                this.listings = null;
                axios.get(param).then(response => (this.listings = response.data)).then(function(error){
                    console.log(error);
                });
            })
        }
    }
</script>