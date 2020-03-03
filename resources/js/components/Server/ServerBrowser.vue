<script>

    Vue.component('server-search', require('./ServerSearch').default);
    Vue.component('server-list', require('./ServerList').default);

    export default {
        data: function () {
            return {
                loading: false,
                post: {
                    data: {},
                    meta: {
                        total: 0,
                    }
                },
                error: null,
                api: '/api/servers',
            }
        },
        async mounted() {
            await this.fetchData();
        },
        watch: {
            '$route': 'fetchData'
        },
        methods: {
            changePage(pageNumber) {
                this.currentPage = pageNumber;
                this.fetchData();
            },
            fetchData () {
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
        },
    }
</script>
