<template>
    <div class="collection">
        <div class="item" v-for="item in items.data">
            <p>{{ item.name }}</p>
            <p>{{ item.type }}</p>
            <p v-if="item.slots > 0">{{ item.slots }}</p>
        </div>
    </div>
</template>

<script>
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
