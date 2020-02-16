<template>
    <div class="tw-hidden lg:tw-block">
        <div class="heading">
            <h3>Filtered Search</h3>
        </div>
        <transition name="fade" mode="out-in">
            <div id="filters" class="d-flex tw-shadow flex-column content p-2 rounded tw-mb-6 lg:tw-mb-0">
                <select style="color: #545c64" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">Renewal Items</option>
                </select>
                <select style="color: #545c64" v-model="type"  @change="updateQuery" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">Any items</option>
                    <option value="consumable">Consumable items</option>
                    <option value="etc">Etc items</option>
                    <option value="weapon">Weaponry items</option>
                    <option value="ammo">Ammo items</option>
                    <option value="armor">Armory items</option>
                    <option value="card">Card items</option>
                </select>

                <select style="color: #545c64" v-if="type == 'consumable'" v-model="subtype" @change="updateQuery" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">Any subtypes</option>
                    <option value="regeneration">Regeneration subtypes</option>
                    <option value="special">Special subtypes</option>
                </select>
                <select style="color: #545c64" v-if="type == 'weapon'" v-model="subtype" @change="updateQuery" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">Any subtypes</option>
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

                <select style="color: #545c64" v-if="type == 'weapon'" v-model="element" @change="updateQuery" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
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

                <select style="color: #545c64" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">Ordered By ID</option>
                </select>
                <div class="mt-2">
                    <at-input v-model="search" @change="updateQuery" placeholder="Search items" prepend-button append-button>
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
                mode: 'renewal',
                category: 'items',
                type: 'all',
                subtype: 'all',
                element: 'all',
                search: '',
            }
        },
        methods: {
            updateQuery: function() {
                this.$router.push({query: {
                    mode: this.mode, 
                    category: this.category, 
                    type: this.type,
                    subtype: this.subtype,
                    element: this.element,
                    search: this.search ? this.search : 'all'
                }});
            }
        }
    }
</script>

<style scoped>

</style>
