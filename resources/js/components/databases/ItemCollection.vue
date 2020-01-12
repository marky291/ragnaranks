<template>
    <div class="collection">
        <item v-for="item in items.data" :key="item.id" :item="item"/>
    </div>
</template>

<script>
    Vue.component('item', require('./Item').default);

    export default {
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
        created() {
            axios.get(`${this.resource}?page=${this.currentPage}`).then((response) => {
                this.items = response.data;
            });
        },
    }
</script>
