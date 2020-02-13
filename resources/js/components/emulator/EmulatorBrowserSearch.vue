<template>
    <div class="tw-hidden lg:tw-block">
        <div class="heading">
            <h3>Filtered Search</h3>
        </div>
        <transition name="fade" mode="out-in">
            <div id="filters" class="d-flex tw-shadow flex-column content p-2 rounded tw-mb-6 lg:tw-mb-0">
                <select style="color: #545c64" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">All Item Types</option>
                </select>
                <select style="color: #545c64" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">With Any Elements</option>
                </select>
                <select style="color: #545c64" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">Ordered By ID</option>
                </select>
                <div class="mt-2">
                    <at-input v-model="search" @change="searchItems" placeholder="Search items" prepend-button append-button>
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
                search: '',
            }
        },
        methods: {
            searchItems: function() {
                if (this.search) {
                    this.$router.push({path: 'items', query: {search: this.search}})
                } else {
                    this.$router.replace({'search': null});
                }
            }
        }
    }
</script>

<style scoped>

</style>
