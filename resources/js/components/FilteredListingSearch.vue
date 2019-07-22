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
                this.$emit('filter:changed', "api/servers/" + this.rates + "/" + this.mode + "/"  + this.tag + "/" + this.sort + "/" + this.paginate);
            }
        }
    }
</script>