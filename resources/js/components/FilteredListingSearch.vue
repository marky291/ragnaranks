<script>
    export default {
        created: function () {
            this.emitFilterEvent();
        },
        data: function () {
            return {
                tags: [],
                rates: 'all',
                mode: 'all',
                sort: 'rank',
                tag: 'all',
                paginate: '7',
            }
        },

        methods: {
            getUrl: function() {
                return "api/servers/" + this.rates + "/" + this.mode + "/"  + this.tag + "/" + this.sort + "/" + this.paginate;
            },
            filterChanged: function() {
                this.emitFilterEvent();
            },
            emitFilterEvent: function() {
                this.$root.$emit('filter:changed', this.getUrl());
            }
        }
    }
</script>

<style>
    /*//*/
</style>
