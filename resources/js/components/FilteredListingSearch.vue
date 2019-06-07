<script>
    export default {
        created: function () {
            this.emitFilterEvent();
        },
        data: function () {
            return {
                tags: [],
                type: 'all',
                mode: 'any',
                sort: 'rank',
                tag: 'all',
                paginate: '7',
            }
        },

        methods: {
            getUrl: function() {
                return "servers/" + this.type + "/" + this.mode + "/"  + this.tag + "/" + this.sort + "/" + this.paginate;
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
