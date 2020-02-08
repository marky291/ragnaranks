<template>
    <div class="tw-hidden lg:tw-block">
        <div class="heading">
            <h3>Filtered Search</h3>
        </div>
        <transition name="fade" mode="out-in">
            <div id="filters" class="d-flex tw-shadow flex-column content p-2 rounded tw-mb-6 lg:tw-mb-0">
                <select style="color: #8795a1" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">value</option>
                    <option value="">value</option>
                </select>
                <select style="color: #8795a1" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">value</option>
                    <option value="">value</option>
                </select>
                <select style="color: #8795a1" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">value</option>
                    <option value="">value</option>
                </select>
                <select style="color: #8795a1" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">value</option>
                    <option value="">value</option>
                </select>

                <div class="mt-2">
                    <at-input v-model="search" @change="itemSearch" placeholder="Search items" prepend-button append-button>
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
            itemSearch: function() {
                this.$emit("item:search", this.search);
            }
        }
    }
</script>

<style scoped>

</style>
