<script>
    export default {
        created: function () {
            this.filterChanged();
        },
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
                this.$root.$emit('filter:changed', "api/servers/" + this.rates + "/" + this.mode + "/"  + this.tag + "/" + this.sort + "/" + this.paginate);
            }
        }
    }
</script>