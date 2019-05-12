<template>
    <transition name="fade" mode="out-in">
        <div id="filters" class="d-flex flex-column content p-2 rounded">
            <select @change="filterChanged" v-model="type" class="mb-2 form-control-sm tw-text-grey-dark tw-text-sm tw-bg-grey-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                <option value="all" selected>Any Rates</option>
                <option value="classic">Official Rates</option>
                <option value="low-rate">Low Rates</option>
                <option value="mid-rate">Mid Rates</option>
                <option value="high-rate">High Rates</option>
                <option value="custom">Instant Rates</option>
            </select>

            <select @change="filterChanged" v-model="mode" class="mb-2 form-control-sm tw-text-grey-dark tw-text-sm tw-bg-grey-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                <option value="any" selected>Any Mode</option>
                <option value="renewal">Renewal</option>
                <option value="pre-renewal">Pre-Renewal</option>
                <option value="classic">Official</option>
                <option value="custom">Custom</option>
            </select>

            <select @change="filterChanged" v-model="tag" class="mb-2 form-control-sm tw-text-grey-dark tw-text-sm tw-bg-grey-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                <option value="all" selected>With Any Tags</option>
                <option v-for="tag in tags" :value="tag['tag']">{{ tag['name'] }}</option>
            </select>

            <select @change="filterChanged" v-model="sort" class="mb-2 form-control-sm tw-text-grey-dark tw-text-sm tw-bg-grey-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                <option value="rank" selected>Sorted by Rank Position</option>
                <option value="name">Sorted by Server Name</option>
                <option value="created_at">Sorted by Date Added</option>
            </select>

            <select @change="filterChanged" v-model="paginate" class="form-control-sm tw-text-grey-dark tw-text-sm tw-bg-grey-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                <option value="25" selected>And show 25 servers</option>
                <option value="50">And show 50 servers</option>
                <option value="100">And show 100 servers</option>
                <option value="250">And show 250 servers</option>
                <option value="500">And show 500 servers</option>
            </select>
        </div>
    </transition>
</template>

<script>
    export default {
        created: function () {
            this.emitFilterEvent();
        },

        props: ['tags'],

        data: function () {
            return {
                type: 'all',
                mode: 'any',
                sort: 'rank',
                tag: 'all',
                paginate: '25',
            }
        },

        methods: {
            getUrl: function() {
                return "servers/" + this.type + "/" + this.mode + "/"  + this.tag + "/" + this.sort + "/" + this.paginate;
            },
            filterChanged: function() {
                console.log('Sending Query: ' + this.getUrl());
                this.emitFilterEvent();
            },
            emitFilterEvent: function() {
                this.$root.$emit('filter:changed', this.getUrl());
            }
        }
    }
</script>

<style>
    /*//*/
</style>