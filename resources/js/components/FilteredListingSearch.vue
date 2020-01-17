<script>
    export default {
        data: function () {
            return {
                rates: 'all',
                mode: 'all',
                sort: 'rank',
                tag: 'all',
                paginate: '10',
                search: '',
                searchPlaceholder: 'Or search for something specific...',
            }
        },
        methods: {
            filterChanged: function() {
                this.clearSearchData();
                let filter = "/api/servers/" + this.rates + "/" + this.mode + "/"  + this.tag + "/" + this.sort + "/" + this.paginate;
                this.$emit('filter:changed', filter);
                ga('set', 'page', filter);
                ga('send', 'pageview');
                ga('send', 'event', 'Filter Changed', 'viewing', filter);
            },
            searchServers: function() {
                this.resetFilterSelections();
                if (this.search === "") {
                    this.filterChanged();
                } else {
                    this.$emit('search:text', "/api/servers/search?query=" + this.search);
                }
            },
            clearSearchData: function() {
                if (this.search) {
                    this.search = '';
                }
            },
            resetFilterSelections: function() {
                this.rates = 'all';
                this.mode = 'all';
                this.sort = 'rank';
                this.tag = 'all';
                this.paginate = '10';
            }
        }
    }
</script>
