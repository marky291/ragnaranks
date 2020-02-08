<template>
    <div class="tw-flex tw-flex-wrap">
        <div @click="ShowItem(item.route)" class="database-item hover:tw-shadow-lg hover:tw-cursor-pointer tw-flex-grow tw-shadow tw-bg-white tw-p-4 tw-flex tw-rounded tw-mb-3 tw-mx-2" style="width:45%" v-for="item in items" :key="item.id">
            <div class="tw-mr-4">
                <img class="tw-shadow" :src="item.image" alt="" width="90px">
            </div>
            <div class="">
                <div class="tw-flex">
                    <p class="tw-font-bold tw-text-md tw-mb-2" style="font-size:13px">{{ item.name }} #{{ item.id }}</p>
                    <!-- <img :src="item.icon" alt=""> -->
                </div>
                <p>Dropped by: <a href="">{{ item.monsterCount }} Monsters</a></p>
                <p>Sold By: <a href="">{{ item.merchantCount }} Vendors</a></p>
                <p>Contained In: <a href="">{{ item.containerCount }} Boxes</a></p>
                <p class="tw-mt-2 tw-font-semibold" style="font-size:13px">Type: {{ item.type }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['items'],
        methods: {
            ShowItem: function(route) {
                window.location.href = route;
            },
        }
    }
</script>

<style scoped>

</style>
