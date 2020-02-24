<script>

    Vue.component('browser-search', require('./BrowserSearch').default);
    Vue.component('browser-monsters', require('./BrowserMonsters').default);
    Vue.component('browser-items', require('./BrowserItems').default);

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
            this.fetchData();
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
            currentCategory(category) {
                return this.$route.query.category == category;
            }
        }
    }
</script>
