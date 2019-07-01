<template>
    <transition-group name="staggered-fade"
                      v-bind:css="false"
                      v-on:before-enter="beforeEnter"
                      v-on:enter="enter"
                      v-on:leave="leave">
        <div v-for="(listing, index) in listings" :key="listing['id']" :data-index="listing['id']">
            <div class="mb-3 server-card item flex-fill tw-shadow border rounded">
                <div class="server-card-head image rounded-top" v-bind:style="{ 'background-image': 'url(' + listing['background'] + ')' }"></div>
                <div class="server-card-head overlap d-flex">
                    <div class="left-side d-flex w-75 flex-column align-items-start px-4 py-2 align-self-end">
                        <h1 class="font-weight-bold mb-0" style="font-size: 26px; color:rgb(243, 243, 243);">{{ listing['name'] }}</h1>
                        <ul class="tag-list tw-list-reset tw-flex tw-text-xs tw-text-green-light" style="font-size:13px; margin-bottom: .5rem">
                            <li v-for="tag in listing.tags" class="mr-2">#{{ tag }}</li>
                        </ul>
                    </div>
                    <div class="right-side flex-fill d-flex justify-content-end pr-3" style="padding-bottom:12px;">
                        <div class="d-flex flex-column justify-content-end mr-3" style="height:100%;">
                            <h3 class="card-counter-title mb-0 font-weight-bold transparency">Votes</h3>
                            <span class="card-counter font-weight-bold transparency">{{ listing['ranking']['votes']}}</span>
                        </div>
                        <div class="d-flex flex-column justify-content-end mr-2" style="height:100%;">
                            <h3 class="card-counter-title mb-0 font-weight-bold transparency">Clicks</h3>
                            <span class="card-counter font-weight-bold transparency">{{ listing['ranking']['clicks']}}</span>
                        </div>
                        <div class="d-flex flex-column justify-content-end" style="height:100%;">
                            <img class="tw-w-6 tw-h-6 tw-shadow tw-mr-2" :src="'/img/flags/'+listing.language+'.svg'" alt="">
                        </div>
                    </div>
                </div>
                <div class="server-card-body align-items-center tw-shadow-inner px-4 py-3 d-flex">
                    <span class="tw-mr-4 tw-text-grey-darker" style="font-size:30px">{{ listing['ranking']['rank'] }}</span>
                    <div class="tw-border-l-2 tw-pl-4 tw-border-grey-light flex-fill pr-3">
                        <p class="tw-text-grey-darkest tw-tracking-tight tw-font-semibold mb-0" style="font-size:14px">High Rate Server <small class="tw-text-grey-darker">({{ listing.config.base_exp_rate }}x/{{ listing.config.job_exp_rate }}x)</small></p>
                        <p class="tw-text-green-dark">with mostly positive reviews</p>
                    </div>

                    <div class="tw-w-1/4 tw-flex tw-justify-end tw-flex-1">
                        <at-button @click="visit(listing['slug'])" hollow class="tw-mr-2 tw-shadow">Website</at-button>
                        <at-button @click="visit(listing['slug'])" type="primary" class="tw-shadow">Details</at-button>
                    </div>
                </div>
            </div>
        </div>
    </transition-group>
</template>

<script>
    import axios from 'axios';
    import Velocity from 'velocity-animate';

    export default {
        components: {
            //
        },
        data: function () {
            return {
                listings: [],
                pagination: {},
            }
        },

        created: function(){
            axios.get('api/servers/all/all/all/rank/7?page=1').then(response => {
                this.listings = response.data.data;
            });

            this.$root.$on('filter:changed', (param) => {
                axios.get(param).then(response => {
                    this.listings = response.data.data
                });
            })
        },
        methods: {
            visit: function(slug) {
                window.location.href = '/listing/' + slug;
            },
            infiniteHandler($state) {
                axios.get('test', {
                    params: {
                        page: this.page,
                    },
                }).then(({ data }) => {
                    if (data.hits.length) {
                        this.page += 1;
                        this.list.push(...data.hits);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                });
            },
            beforeEnter: function (el) {
                el.style.opacity = 0
                el.style.height = 0
            },
            enter: function (el, done) {
                var delay = el.dataset.index * 0.4
                setTimeout(function () {
                    Velocity(
                        el,
                        { opacity: 1, height: '270px' },
                        { complete: done }
                    )
                }, delay)
            },
            leave: function (el, done) {
                var delay = el.dataset.index * 0.4
                setTimeout(function () {
                    Velocity(
                        el,
                        { opacity: 0, height: 0 },
                        { complete: done }
                    )
                }, delay)
            }
        }
    }
</script>