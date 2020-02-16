<template>
    <div class="tw-hidden lg:tw-block">
        <div class="heading">
            <h3>Filtered Search</h3>
        </div>
        <transition name="fade" mode="out-in">
            <div id="filters" class="d-flex tw-shadow flex-column content p-2 rounded tw-mb-6 lg:tw-mb-0">
                <select style="color:rgb(135, 149, 161)" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">Renewal Items</option>
                </select>
                <select style="color:rgb(135, 149, 161)" v-model="type" @change="itemType" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">Any Items</option>
                    <option value="consumable">Consumable Items</option>
                    <option value="etc">Etc Items</option>
                    <option value="weapon">Weaponry Items</option>
                    <option value="ammo">Ammo Items</option>
                    <option value="armor">Armory Items</option>
                    <option value="card">Card Items</option>
                </select>

                <select style="color:rgb(135, 149, 161)" v-if="type == 'consumable'" v-model="subtype" @change="itemQuery" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">Any Type</option>
                    <option value="regeneration">Regeneration</option>
                    <option value="special">Special</option>
                </select>
                <select style="color:rgb(135, 149, 161)" v-if="type == 'weapon'" v-model="subtype" @change="itemQuery" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">Any Type</option>
                    <option value="sword">Swords</option>
                    <option value="two-handed sword">Two-handed swords</option>
                    <option value="dagger">Daggers</option>
                    <option value="katar">Katars</option>
                    <option value="axe">Axes</option>
                    <option value="undocumented">Undocumented</option>
                    <option value="two-handed axe">Two-handed axes</option>
                    <option value="spear">Spears</option>
                    <option value="two-handed spear">Two-handed spears</option>
                    <option value="two-handed rod">Two-handed rods</option>
                    <option value="mace">Maces</option>
                    <option value="book">Books</option>
                    <option value="rod">Rods</option>
                    <option value="bow">Bows</option>
                    <option value="fist weapon">Fist weapons</option>
                    <option value="instrument">Instruments</option>
                    <option value="whip">Whips</option>
                </select>

                <select style="color:rgb(135, 149, 161)" v-if="type == 'weapon'" v-model="element" @change="itemQuery" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">Any Elements</option>
                    <option value="neutral">Only Neutral Elements</option>
                    <option value="water">Only Water Elements</option>
                    <option value="earth">Only Earth Elements</option>
                    <option value="fire">Only Fire Elements</option>
                    <option value="wind">Only Wind Elements</option>
                    <option value="poison">Only Poison Elements</option>
                    <option value="holy">Only Holy Elements</option>
                    <option value="shadow">Only Shadow Elements</option>
                    <option value="ghost">Only Ghost Elements</option>
                    <option value="undead">Only Undead Elements</option>
                </select>

                <select style="color:rgb(135, 149, 161)" v-if="type == 'weapon' || type == 'armor'" v-model="sorting" @change="itemQuery" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="id">Sort By ID</option>
                    <option value="slots">Sort By Slot Count</option>
                </select>

                <div class="mt-2">
                    <at-input v-model="search" @change="itemQuery" placeholder="Search items" prepend-button append-button>
                        <template slot="prepend">
                            <i class="icon icon-search"/>
                        </template>
                    </at-input>
                </div>
            </div>
        </transition>
    </div>

</template>

<script>
    export default {
        data: function () {
            return {
                mode: this.$route.query.mode ? this.$route.query.mode : 'renewal',
                category: this.$route.query.category ? this.$route.query.category : 'items',
                type: this.$route.query.type ? this.$route.query.type : 'all',
                subtype: this.$route.query.subtype ? this.$route.query.subtype : 'all',
                element: this.$route.query.element ? this.$route.query.element : 'all',
                search: this.$route.query.search ? this.$route.query.search : '',
                sorting: this.$route.query.sorting ? this.$route.query.sorting : 'id',
            }
        },
        methods: {
            itemQuery: function() {
                this.$router.push({query: {
                    mode: this.mode, 
                    category: this.category, 
                    type: this.type,
                    subtype: this.subtype,
                    element: this.element,
                    search: this.search ? this.search : 'all',
                    sorting: this.sorting,
                }});
            },
            itemType: function() {
                this.subtype = 'all';
                this.element = 'all';
                this.sorting = 'id';
                this.itemQuery();
            },
        }
    }
</script>

<style scoped>

</style>
