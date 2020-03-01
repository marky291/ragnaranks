<script>

    Vue.component('server-search', () => import('./ServerSearch'));
    Vue.component('server-list', () => import('./ServerList'));

    export default {
        data: function () {
            return {
                loading: false,
                post: null,
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
        },
    }
</script>
