<script>
    export default {
        data: function () {
            return {
                rates: 'all',
                mode: 'all',
                sort: 'rank',
                tag: 'all',
                paginate: '10',
            }
        },
        methods: {
            filterChanged: function() {
                let filter = "/api/servers/" + this.rates + "/" + this.mode + "/"  + this.tag + "/" + this.sort + "/" + this.paginate;
                this.$emit('filter:changed', filter);
                ga('set', 'page', filter);
                ga('send', 'pageview');
                ga('send', 'event', 'Filter Changed', 'viewing', filter);
            }
        }
    }
</script>
