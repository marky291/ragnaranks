<script>
    import axios from 'axios';

    export default {

        data: function () {
            return {
                listings: [],
                pagination: {},
            }
        },

        created: function(){
            axios.get('/api/listings').then(response => {
                this.listings = response.data.data;
            });

            this.$root.$on('filter:changed', (param) => {
                axios.get(param).then(response => {
                    this.listings = response.data.data
                });
            })
        },
        methods: {
            visit: function(slug) {
                window.location.href = '/listing/' + slug;
            },
        }
    }
</script>