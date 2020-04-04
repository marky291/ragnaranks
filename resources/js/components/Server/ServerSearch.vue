<script>
    export default {
        data: function () {
            return {
                filterable: {
                    tags: {},
                    modes: {},
                    rates: {},
                },
                route: {
                    rates: this.$route.query.rates ? this.$route.query.rates : 'all',
                    modes: this.$route.query.modes ? this.$route.query.modes : 'all',
                    sort: this.$route.query.sort ? this.$route.query.sort : 'rank',
                    tags: this.$route.query.tags ? this.$route.query.tags : 'all',
                    search: this.$route.query.search ? this.$route.query.search : '',
                },
            }
        },
        async created() {
            await axios.get('/api/tags').then((response) => { this.filterable.tags = response.data; });
            await axios.get('/api/modes').then((response) => { this.filterable.modes = response.data; });
            await axios.get('/api/rates').then((response) => { this.filterable.rates = response.data; });
        },
        methods: {
            filterChanged: function() {
                this.$router.push({
                    query: {
                        rates: this.route.rates,
                        modes: this.route.modes,
                        sort: this.route.sort,
                        tags: this.route.tags,
                        search: this.route.search,
                    }
                });
            },
            clearSearchData: function() {
                if (this.search) {
                    this.search = '';
                }
            },
            resetFilterSelections: function() {
                this.rates = 'all';
                this.mode = 'all';
                this.sort = 'rank';
                this.tag = 'all';
                this.paginate = '10';
            },
        }
    }
</script>

<template>
    <div class="tw-hidden lg:tw-block">
        <div class="heading">
            <h3>Filtered Search</h3>
        </div>
        <transition name="fade" mode="out-in">
            <div id="filters" class="d-flex tw-shadow flex-column content p-2 rounded tw-mb-6 lg:tw-mb-0">

                <select @change="filterChanged" v-model="route.rates" style="color: #8795a1" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">Any Rates</option>
                    <option v-for="rate in filterable.rates" :value="rate.name" :key="rate.name">{{ rate.label }} ({{rate.min_exp}}~{{rate.max_exp}})x</option>
                </select>

                <select @change="filterChanged" v-model="route.modes" style="color: #8795a1" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">Any Mode</option>
                    <option v-for="mode in filterable.modes" :value="mode.name" :key="mode.name">{{ mode.label }}</option>
                </select>

                <select @change="filterChanged" v-model="route.tags" style="color: #8795a1" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="all">With any Tags</option>
                    <option v-for="tag in filterable.tags" :value="tag.name" :key="tag.name">{{ tag.label }}</option>
                </select>

                <select @change="filterChanged" v-model="route.sort" style="color: #8795a1" class="mb-2 form-control-sm tw-text-sm tw-bg-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                    <option value="rank">Sorted by Rank Position</option>
                    <option value="name">Sorted by Server Name</option>
                    <option value="creation">Sorted by Date Added</option>
                </select>

                <div class="mt-2">
                    <at-input @change="filterChanged" v-model="route.search" placeholder="Or search for something specific..." prepend-button append-button>
                        <template slot="prepend">
                            <i class="icon icon-search"></i>
                        </template>
                    </at-input>
                </div>
            </div>
        </transition>
    </div>
</template>
