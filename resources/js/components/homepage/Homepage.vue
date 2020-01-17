<script>
    export default {
        data: function () {
            return {
                resource: 'api/servers/all/all/all/rank/10',
                currentPage: 1,
                listings: {
                    data: {},
                    links: {},
                    meta: {},
                },
            }
        },
        created() {
            axios.get(`${this.resource}?page=${this.currentPage}`).then((response) => {
                this.listings = response.data;
            });
        },
        methods: {
            changePage(pageNumber) {
                this.currentPage = pageNumber;
                this.loadResource();
            },
            loadResource() {
                axios.get(`${this.resource}?page=${this.currentPage}`).then((response) => {
                    this.listings = response.data;
                    document.getElementById('listingView').scrollIntoView();
                });
            },
            changeResource(resource) {
                this.resource = resource;
                this.currentPage = 1;
                this.loadResource();
            },
            searchServers(url) {
                axios.get(url).then((response) => {
                    this.listings = response.data;
                    document.getElementById('listingView').scrollIntoView();
                });
            }
        },
    }
</script>
