<script>

    Vue.component('emulator-browser-search', require('./EmulatorBrowserSearch').default);
    Vue.component('emulator-browser-items', () => import('./EmulatorBrowserItems'));

    export default {
        props: ['route'],
        data: function () {
            return {
                resource: '/api/database/items',
                currentPage: 1,
                items: {
                    data: {},
                    links: {},
                    meta: {},
                },
            }
        },
        async mounted() {
            if (this.route) {
                console.log(this.route);
            }

            await this.loadDataRoute();
        },
        methods: {
            loadSearchedItems: function(query) {
                axios.get('/api/database/items/search?query='+query).then((response) => {
                    this.items = response.data;
                });
            },
            changePage: function(pageNumber) {
                this.currentPage = pageNumber;
                this.loadDataRoute();
            },
            loadDataRoute: function() {
                document.getElementById('browser').scrollIntoView();
                return axios.get(`${this.resource}?page=${this.currentPage}`).then((response) => {
                    this.items = response.data;
                });
            },
        }
    }
</script>
