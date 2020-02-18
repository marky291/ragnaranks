<template>
    <div class="">
        <div v-for="monster in monsters" :key="monster.id" class="tw-grid tw-grid-cols-12 tw-row-gap-2 load-animation hover:tw-shadow-lg hover:tw-cursor-pointer tw-shadow tw-border tw-bg-white tw-p-4 tw-rounded tw-mb-3 tw-mx-2">
            <div class="tw-col-span-2 tw-flex tw-items-center tw-justify-center tw-shadow tw-mr-4">
                <img class="" :src="monster.image" alt="" style="max-height:100px;">
            </div>
            <div class="tw-col-span-10">
                <p class="tw-font-bold tw-text-md tw-mb-2" style="font-size:13px">{{ monster.name }} #{{ monster.id }}</p>

                <div class="browsing-list tw-mb-2 tw-grid tw-grid-cols-2 tw-gap-2">
                    <div class="tw-col-span-1">
                        <p class="browsing-item tw-capitalize">Race: <b>{{ monster.race }}</b></p>
                        <p class="browsing-item tw-capitalize">Property: <b>{{ monster.property }}</b></p>
                        <p class="browsing-item tw-capitalize">Size: <b>{{ monster.size }}</b></p>
                    </div>
                    <div class="tw-col-span-1">
                        <p class="browsing-item">Drops: <b>{{ monster.dropCount }} Items</b></p>
                        <p class="browsing-item">Skills: <b>{{ monster.skillCount }} Learned</b></p>
                        <p class="browsing-item">Spawns: <b>{{ monster.spawnCount }} Locations</b></p>
                    </div>
                </div>
                <!-- <at-button @click="ShowMonster(monster.route)" class="tw-w-full" type="primary" size="small">View {{ monster.name }}</at-button> -->

                <div class="tw-grid tw-grid-cols-2 tw-mt-2">
                    <div class="tw-col-span-1">
                        <!-- <p class="tw-font-bold tw-mb-1">Damage Bonuses</p> -->
                        <div class="properties tw-flex">
                            <p v-if="monster.properties.neutral > 100" class="element neutral">Neutral damage +{{ monster.properties.neutral }}%</p>
                            <p v-if="monster.properties.water > 100" class="element water">Water damage +{{ monster.properties.water }}%</p>
                            <p v-if="monster.properties.earth > 100" class="element earth">Earth damage +{{ monster.properties.earth }}%</p>
                            <p v-if="monster.properties.fire > 100" class="element fire">Fire damage +{{ monster.properties.fire }}%</p>
                            <p v-if="monster.properties.wind > 100" class="element wind">Wind damage +{{ monster.properties.wind }}%</p>
                            <p v-if="monster.properties.poison > 100" class="element poison">Poison damage +{{ monster.properties.poison }}%</p>
                            <p v-if="monster.properties.holy > 100" class="element holy">Holy damage +{{ monster.properties.holy }}%</p>
                            <p v-if="monster.properties.dark > 100" class="element dark">Dark damage {{ monster.properties.dark }}%</p>
                            <p v-if="monster.properties.ghost > 100" class="element ghost">Ghost damage +{{ monster.properties.ghost }}%</p>
                            <p v-if="monster.properties.undead > 100" class="element undead" style="background:black">Undead damage +{{ monster.properties.undead }}%</p>
                        </div>
                    </div>
                    <div class="tw-col-span-1 tw-flex tw-items-end">
                        <at-button class="tw-w-full" @click="ShowMonster(monster.route)" type="primary" size="small">View {{ monster.name }}</at-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['monsters'],
        methods: {
            ShowMonster: function(route) {
                window.location.href = route;
            },
        }
    }
</script>

<style scoped>

</style>