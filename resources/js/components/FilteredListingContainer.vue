<template>
    <transition-group name="fade" mode="out-in">
        <div v-for="listing in listings" :key="listing['id']">
                <div class="mb-3 server-card item flex-fill shadow border rounded">
                    <div class="server-card-head image rounded-top" v-bind:style="{ 'background-image': 'url(' + listing['banner_url'] + ')' }">

                    </div>
                    <div class="server-card-head overlap d-flex">
                        <div class="left-side d-flex w-75 flex-column align-items-start px-4 py-2 align-self-end">
                            <h1 class="text-white font-weight-bold mb-0" style="font-size: 24px;">{{ listing['name'] }}</h1>
                            <ul class="tag-list list-unstyled d-flex tw-text-xs tw-text-green-light">
                                <span v-for="tag in listing.tags">
                                    <li class="mr-2">#{{ tag['name']}}</li>
                                </span>
                            </ul>
                        </div>
                        <div class="right-side flex-fill d-flex justify-content-end pr-3" style="padding-bottom:12px;">
                            <div class="d-flex flex-column justify-content-end mr-3" style="height:100%;">
                                <h3 class="card-counter-title mb-0 font-weight-bold transparency">Votes</h3>
                                <span class="card-counter font-weight-bold transparency">{{ listing['votes_count']}}</span>
                            </div>
                            <div class="d-flex flex-column justify-content-end mr-2" style="height:100%;">
                                <h3 class="card-counter-title mb-0 font-weight-bold transparency">Clicks</h3>
                                <span class="card-counter font-weight-bold transparency">{{ listing['clicks_count']}}</span>
                            </div>
                            <div class="d-flex flex-column justify-content-end" style="height:100%;">
                                <img src="/img/flags/english.png" alt="EN">
                            </div>
                        </div>
                    </div>
                    <div class="server-card-body align-items-center px-4 py-3 d-flex">
                        <div class="rating rounded-circle mr-3 d-flex font-weight-bold justify-content-center align-items-center" style="min-height:50px; min-width:50px;">
                            {{ listing['rank'] }}
                        </div>
                        <div class="flex-fill pr-3">
                            <p class="font-weight-bold mb-0">N/A ({{ listing['configs']['base_exp_rate'] }}x/{{ listing['configs']['job_exp_rate']}}x)</p>
                            <p class="text-muted">{{ listing['description']}}</p>
                        </div>
                        <button type="button" class="btn btn-blue btn-sm text-white" style="min-width: 60px;">View <i class="fas fa-long-arrow-alt-right"></i></button>
                    </div>
                </div>
            </div>
    </transition-group>
</template>

<script>
    import axios from 'axios';

    export default {
        data: function () {
            return {
                listings: '',
            }
        },

        mounted() {
            this.$root.$on('filter:changed', (param) => {
                console.log('Received Query: ' + param);
                this.listings = null;
                axios
                    .get(param)
                    .then(response => (this.listings = response.data.listings));
                this.$forceUpdate();
            })
        }
    }
</script>