<script>
    export default {
        data: function () {
            return {
                rates: 'all',
                mode: 'all',
                sort: 'rank',
                tag: 'all',
                paginate: '7',
            }
        },
        methods: {
            filterChanged: function() {
                let filter = "api/servers/" + this.rates + "/" + this.mode + "/"  + this.tag + "/" + this.sort + "/" + this.paginate;
                ga('send', 'event', 'Filter Changed', 'viewing', filter);
                this.$emit('filter:changed', filter);
            }
        }
    }
</script>
