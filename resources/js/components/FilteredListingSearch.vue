<template>
    <transition name="fade" mode="out-in">
        <div id="filters" class="d-flex flex-column content p-2 rounded">
            <select @change="filterChanged" v-model="rate" class="mb-2 form-control-sm tw-text-grey-dark tw-text-sm tw-bg-grey-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
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

            <select class="mb-2 form-control-sm tw-text-grey-dark tw-text-sm tw-bg-grey-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                <option @change="filterChanged" v-model="tag" value="all">With Any Tags</option>
<!--                @foreach(\App\Tag::all() as $tag)-->
<!--                <option>With {{ ucfirst($tag->name) }}</option>-->
<!--                @endforeach-->
            </select>

            <select @change="filterChanged" v-model="sort" class="mb-2 form-control-sm tw-text-grey-dark tw-text-sm tw-bg-grey-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                <option value="name" selected>Sorted by Server Name</option>
                <option value="rank">Sorted by Rank Position</option>
                <option value="created_at">Sorted by Date added</option>
                <option value="created_at">Sorted by Online since</option>
            </select>

            <select @change="filterChanged" v-model="quantity" class="form-control-sm tw-text-grey-dark tw-text-sm tw-bg-grey-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
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

        data: function () {
            return {
                rate: 'all',
                mode: 'any',
                sort: 'name',

                // not implemented
                tag: '',
                quantity: '25',
            }
        },

        methods: {
            getUrl: function() {
                return "servers/" + this.rate + "/" + this.mode + "/"  + this.sort + "/desc";
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