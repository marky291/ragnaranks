<script>

    Vue.component('emulator-browser-search', require('./EmulatorBrowserSearch').default);
    Vue.component('emulator-browser-items', () => import('./EmulatorBrowserItems'));

    export default {
        data: function () {
            return {
                loading: false,
                post: null,
                error: null,
                api: '/api',
            }
        },
        created() {
            console.log(this.$route.query.mode);
            console.log(this.$route.query.category);
            this.fetchData()
        },
        watch: {
            '$route': 'fetchData'
        },
        methods: {
            fetchData () {
                this.error = this.post = null;
                this.loading = true;
                axios.get(this.api + this.$route.fullPath)
                    .then((response) => {
                        this.post = response.data;
                    }).catch((error) => {
                        this.error = error;
                    }).then(() => {
                        this.loading = false
                    });
            },
            changePage: function(pageNumber) {
                this.$router.push({ query: Object.assign({}, $route.query, { page: pageNumber }) })
            },
        }
    }
</script>
