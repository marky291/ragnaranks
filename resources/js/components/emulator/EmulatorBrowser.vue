<script>

    Vue.component('emulator-browser-search', require('./EmulatorBrowserSearch').default);
    Vue.component('emulator-browser-items', () => import('./EmulatorBrowserItems'));

    export default {
        data: function () {
            return {
                loading: false,
                post: null,
                error: null
            }
        },
        created() {
            this.fetchData()
        },
        watch: {
            '$route': 'fetchData'
        },
        methods: {
            fetchData () {
                this.error = this.post = null
                this.loading = true
                axios.get('/api/database/items?search=' + this.$route.query.search)
                    .then((response) => {
                        this.post = response.data;
                    }).catch((error) => {
                        this.error = error;
                    }).then(() => {
                        this.loading = false
                    });
            },
            changePage: function(pageNumber) {
                this.currentPage = pageNumber;
            },
        }
    }
</script>
