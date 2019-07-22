<script>
    export default {
        data: function () {
            return {
                resource: 'api/servers/all/all/all/rank/7',
                currentPage: 1,
                listings: {
                    data: {},
                    links: {},
                    meta: {
                        per_page: Number,
                    },
                },
            }
        },
        created() {
            this.loadResource();
        },
        methods: {
            changePage(pageNumber) {
                this.currentPage = pageNumber;
                this.loadResource();
            },
            loadResource() {
                axios.get(`${this.resource}?page=${this.currentPage}`).then((response) => {
                    this.listings = response.data;
                });
            },
            changeResource(resource) {
                console.log('resource : ' + resource);
                this.resource = resource;
                this.currentPage = 1;
                this.loadResource();
            },
        },
    }
</script>