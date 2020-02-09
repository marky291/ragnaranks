<template>
    <div class="tw-flex tw-flex-col tw-flex-1">
        <div class="database-item hover:tw-shadow-lg hover:tw-cursor-pointer tw-shadow tw-border tw-bg-white tw-p-4 tw-rounded tw-mb-3 tw-mx-2" v-for="item in items" :key="item.id">
            <div class="tw-flex">
                <div class="tw-flex tw-flex-1">
                    <div class="tw-mr-6">
                        <img class="tw-shadow" :src="item.image" alt="" width="90px">
                    </div>
                    <div class="tw-mr-4 tw-w-2/3">
                        <p class="tw-font-bold tw-text-md tw-mb-2" style="font-size:13px">{{ item.name }} #{{ item.id }}</p>
                        <p v-html="item.description"></p>
                        <p class="tw-mt-2 tw-font-semibold" style="font-size:13px">Type: {{ item.type }} & {{ item.subType }}</p>
                        <div v-if="item.script" class="tw-flex tw-mt-4">
                            <p class="tw-bg-gray-200 tw-w-full tw-p-1 tw-rounded"><b>//</b> {{item.script}}</p>
                        </div>

                    </div>
                </div>
                <div class="tw-w-1/3">
                    <div class="tw-flex tw-justify-between tw-items-center tw-mb-2">
                        <p class="tw-font-bold tw-text-md" style="font-size:13px">Quick Glance</p>
                        <img class="tw-mr-2" :src="item.icon" alt="">
                    </div>
                    <ul class="glance tw-mb-1">
                        <li v-if="item.buy">Buyable For: <b>{{ item.buy }}</b>z</li>
                        <li v-if="item.sell">Sellable For: <b>{{ item.sell }}</b>z</li>
                        <li>Weight Per Item: <b>{{ item.weight }}</b></li>
                        <li v-if="item.monsterCount">Dropped by: <b>{{ item.monsterCount }} Monsters</b></li>
                        <li v-if="item.merchantCount">Sold By: <b>{{ item.merchantCount }} Vendors</b></li>
                        <li v-if="item.containerCount">Contained In: <b>{{ item.containerCount }} Boxes</b></li>
                    </ul>
                    <at-button @click="ShowItem(item.route)" class="tw-w-full" type="primary" size="small">View {{ item.name }}</at-button>
                </div>
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
