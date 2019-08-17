<template>
    <transition-group name="staggered-fade"
                      v-bind:css="false"
                      v-on:before-enter="beforeEnter"
                      v-on:enter="enter"
                      v-on:leave="leave">
        <div v-for="listing in data" :key="listing['id']" :data-index="listing['id']">
            <div class="mb-3 server-card item flex-fill tw-shadow border rounded">
                <div class="server-card-head image rounded-top" v-bind:style="{ 'background-image': 'url(' + space + '/' + listing['background'] + ')' }"></div>
                <div @click="visitProfile(listing)" class="server-card-head hover:tw-bg-transparent tw-cursor-pointer overlap d-flex">
                    <div class="left-side d-flex w-75 flex-column align-items-start px-4 py-2 align-self-end">
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
                        <div class="d-flex flex-column justify-content-end" style="height:100%;">
                            <img class="tw-w-6 tw-h-6 tw-shadow tw-mr-2" :src="'/img/flags/'+listing.language+'.svg'" alt="">
                        </div>
                    </div>
                </div>
                <div class="server-card-body align-items-center tw-shadow-inner px-4 py-3 d-flex">
                    <span class="tw-mr-4 tw-text-gray-600" style="font-size:30px">{{ listing['ranking']['rank'] }}</span>
                    <div class="tw-border-l-2 tw-pl-4 tw-border-grey-light flex-fill pr-3">
                        <p class="tw-text-gray-700 tw-tracking-tighter tw-font-semibold mb-0" style="font-size:14px">{{ $t('homepage.card.rate.'+listing['config']['title']) }} <small class="tw-text-gray-600">({{ listing['config']['base_exp_rate'] }}x/{{ listing['config']['job_exp_rate'] }}x)</small></p>
                        <p :class="'review-score-'+listing.review_score">{{ $t(reviewScoreMessage(listing.review_score)) }}</p>
                    </div>
                    <div class="tw-w-1/4 tw-flex tw-justify-end tw-flex-1">
                        <a :href="listing.website" rel="noopener" @click="incrementClick(listing)" :name="'Redirect from ragnaranks to '+listing.website" target="_blank" class="at-btn tw-mr-2 tw-shadow at-btn--default at-btn--default--hollow at-btn__text">Website</a>
                        <a :href="`/listing/${listing.slug}`" :name="'View '+listing.name+' profile on Ragnaranks'" class="at-btn tw-shadow hover:tw-text-white at-btn--primary at-btn__text">Details</a>
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
                if (score > 2) return 'homepage.card.review.positive';
                if (score === 2) return 'homepage.card.review.mediocre';
                if (score > 0) return 'homepage.card.review.negative';
                return 'homepage.card.review.fresh';
            },
            incrementClick: function(listing) {
                axios.post(`/listing/${listing.slug}/clicks`).then((response) => {
                    if(response.data.success === true) {
                        listing.ranking.clicks++;
                    }
                });
                ga('send', 'event', 'website', 'clicked', this.listing.name);
            },
            beforeEnter: function (el) {
                el.style.opacity = 0;
                el.style.height = 0;
            },
            enter: function (el, done) {
                var delay = el.dataset.index * 0.4;
                setTimeout(function () {
                    Velocity(
                        el,
                        { opacity: 1, height: '270px' },
                        { complete: done }
                    )
                }, delay)
            },
            leave: function (el, done) {
                var delay = el.dataset.index * 0.4;
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
