<template>
    <transition-group name="staggered-fade" v-bind:css="false" v-on:before-enter="beforeEnter" v-on:enter="enter" v-on:leave="leave">
        <div v-for="listing in data" :key="listing['id']" :data-index="listing['id']">
            <div class="mb-3 server-card item flex-fill tw-shadow border rounded">
                <div class="server-card-head image rounded-top" v-bind:style="{ 'background-image': 'url(' + space + '/' + listing['background'] + ')' }"></div>
                <div @click="openProfile(listing)" class="server-card-head hover:tw-bg-transparent tw-cursor-pointer overlap tw-flex tw-flex-col tw-justify-between">
                    <div class="tw-text-right">
                        <div v-if="listing.heartbeat.recorder != 'none'" class="tw-shadow tw-inline-block tw-px-3 tw-py-1 tw-rounded-l" style="font-size:9px; background-color: rgba(247, 247, 247, 1)">
                            <i class="fas fa-circle tw-ml-1" :class="listing.heartbeat.login == 'online' ? 'tw-text-green-500' : 'tw-text-red-500'"></i> Login
                            <i class="fas fa-circle tw-ml-1" :class="listing.heartbeat.char == 'online' ? 'tw-text-green-500' : 'tw-text-red-500'"></i> Char
                            <i class="fas fa-circle tw-ml-1" :class="listing.heartbeat.map == 'online' ? 'tw-text-green-500' : 'tw-text-red-500'"></i> Map
                            <span v-if="listing.heartbeat.players > 0">
                                || <i class="fas fa-gamepad tw-ml-1" style="font-size:12px"></i> {{ listing.heartbeat.players }}
                            </span>
                        </div>
                    </div>
                    <div class="tw-flex">
                        <div class="left-side d-flex w-75 flex-column px-4 py-2 align-self-end">
                            <h1 class="font-weight-bold mb-0" style="font-size: 26px; color:rgb(243, 243, 243);">{{ listing['name'] }}</h1>
                            <ul class="tag-list tw-flex tw-flex-wrap tw-text-xs tw-text-green-light" style="font-size:13px; margin-bottom: .5rem; width:inherit">
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
                            <div class="d-flex flex-column justify-content-end" style="height:100%; width:22px;">
                                <img class="tw-w-6 tw-h-6 tw-shadow tw-mr-2" :src="'/img/flags/'+listing.language+'.svg'" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="server-card-body align-items-center tw-shadow-inner px-4 py-3 d-flex">
                    <span class="tw-mr-4 tw-text-gray-600" style="font-size:30px">{{ listing['ranking']['rank'] }}</span>
                    <div class="tw-border-l-2 tw-pl-4 tw-pr-5 tw-border-grey-light">
                        <p class="tw-text-gray-700 tw-tracking-tighter tw-font-semibold mb-0" style="font-size:14px">{{ $t('homepage.card.rate.'+listing['config']['title']) }}</p>
                        <p :class="'review-score-'+listing.review_score">{{ $t(reviewScoreMessage(listing.review_score)) }}</p>
                    </div>
                    <div class="tw-flex-1 tw-pr-12 tw-py-1 tw-flex tw-leading-tight tw-text-gray-700" style="font-size:8px; justify-content: space-evenly; border-left: 1px dashed #cacaca;">
                        <div class="">
                            <p><span class="tw-font-bold">Mode</span>: <span class="tw-text-gray-600 tw-capitalize">{{ listing.mode }} </span></p>
                            <p><span class="tw-font-bold">Max Base</span>: <span class="tw-text-gray-600">{{ listing.config.max_base_level }}</span></p>
                            <p><span class="tw-font-bold">Max Job</span>: <span class="tw-text-gray-600">{{ listing.config.max_job_level }}</span></p>
                        </div>
                        <div class="">
                            <p><span class="tw-font-bold">Drop Rate</span>: <span class="tw-text-gray-600">{{ listing.config.item_drop_common }}x</span></p>
                            <p><span class="tw-font-bold">Base Exp</span>: <span class="tw-text-gray-600">{{ listing.config.base_exp_rate }}x</span></p>
                            <p><span class="tw-font-bold">Job Exp</span>: <span class="tw-text-gray-600">{{ listing.config.job_exp_rate }}x</span></p>
                        </div>
                    </div>
                    <div class="tw-flex tw-justify-end">
                        <a :href="listing.website" rel="noopener" @click="incrementClick(listing)" :name="'Redirect from ragnaranks to '+listing.website" target="_blank" class="at-btn tw-mr-2 tw-shadow at-btn--default at-btn--default--hollow at-btn__text"><i class="fas fa-globe-americas"></i></a>
                        <a :href="`/listing/${listing.slug}`" :name="'View '+listing.name+' profile on Ragnaranks'" class="at-btn tw-shadow hover:tw-text-white at-btn--primary at-btn__text" style="display:flex">Explore</a>
                    </div>
                </div>
            </div>
        </div>
        <div :style="$parent.listings.meta.total === 0 ? 'display: block !important' : null" :key="9999999" class="tw-hidden">
            <div class="tw-flex">
                <i class="fas fa-search tw-text-5xl tw-mr-4"></i>
                <div class="tw-flex tw-flex-col">
                    <h3>Whoops, No listings found with your search parameters</h3>
                    <p>It could just be that no such servers exist or they just have not found their home at ragnaranks yet!</p>
                </div>
            </div>
        </div>
    </transition-group>
</template>

<script>
    import Velocity from 'velocity-animate';

    export default {
        props: ['data', 'space'],
        methods: {
            reviewScoreMessage: function(score) {
                if (score > 3) return 'homepage.card.review.positive';
                if (score > 2) return 'homepage.card.review.mediocre';
                if (score > 0) return 'homepage.card.review.negative';
                return 'homepage.card.review.fresh';
            },
            incrementClick: function(listing) {
                axios.post(`/listing/${listing.slug}/clicks`).then((response) => {
                    listing.ranking.clicks++;
                });
                ga('send', 'event', 'website', 'clicked', this.listing.name);
            },
            openProfile: function(listing) {
                window.open(`/listing/${listing.slug}`, '_self');
            },
            beforeEnter: function (el) {
                el.style.opacity = 0;
                el.style.height = 0;
            },
            enter: function (el, done) {
                let delay = el.dataset.index * .2;
                setTimeout(function () {
                    Velocity(
                        el,
                        { opacity: 1, height: '280px' },
                        { complete: done }
                    )
                }, delay)
            },
            leave: function (el, done) {
                let delay = el.dataset.index * .2;
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
