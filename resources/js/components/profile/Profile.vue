<template>
        <div class="tw-shadow" v-if="$parent.profileLoaded">
            <div :class="'use-accent-'+$parent.listing.accent" class="mb-3 server-card item flex-fill border rounded">
                <div id="profile-card" class="profile-block">
                    <div class="server-card-head-large image rounded-top" style="height:350px;" v-bind:style="{ backgroundImage: 'url(' + space + $parent.listing.background + ')' }"></div>
                    <div class="server-card-head-large hover:tw-bg-transparent tw-cursor-pointer overlap tw-flex tw-flex-col tw-justify-between" style="margin-top:-350px;">
                        <div class="tw-text-right">
                            <div v-if="$parent.slug != 'defaults' && $parent.listing.heartbeat.recorder != 'none'" class="tw-shadow tw-inline-block tw-px-3 tw-py-1 tw-rounded-l" style="font-size:9px; background-color: rgba(247, 247, 247, 1)">
                                <i class="fas fa-circle tw-ml-1" :class="$parent.listing.heartbeat.login == 'online' ? 'tw-text-green-500' : 'tw-text-red-500'"></i> Login
                                <i class="fas fa-circle tw-ml-1" :class="$parent.listing.heartbeat.char == 'online' ? 'tw-text-green-500' : 'tw-text-red-500'"></i> Char
                                <i class="fas fa-circle tw-ml-1" :class="$parent.listing.heartbeat.map == 'online' ? 'tw-text-green-500' : 'tw-text-red-500'"></i> Map
                                <span v-if="$parent.listing.heartbeat.players > 0">
                                || <i class="fas fa-gamepad tw-ml-1" style="font-size:12px"></i> {{ $parent.listing.heartbeat.players }}
                            </span>
                            </div>
                        </div>
                        <div class="tw-flex">
                            <div class="left-side d-flex w-75 flex-column px-4 py-2 align-self-end">
                                <h1 class="font-weight-bold mb-0" style="font-size: 26px; color:rgb(243, 243, 243);">{{ $parent.listing['name'] }}</h1>
                                <ul class="tag-list tw-flex tw-flex-wrap tw-text-xs tw-text-green-light" style="font-size:13px; margin-bottom: .5rem; width:inherit">
                                    <li v-for="tag in $parent.listing.tags" class="mr-2">#{{ tag }}</li>
                                </ul>
                            </div>
                            <div class="right-side flex-fill d-flex justify-content-end pr-3" style="padding-bottom:12px;">
                                <div class="d-flex flex-column justify-content-end mr-3" style="height:100%;">
                                    <h3 class="card-counter-title mb-0 font-weight-bold transparency">Votes</h3>
                                    <span class="card-counter font-weight-bold transparency">{{ $parent.listing['ranking']['votes']}}</span>
                                </div>
                                <div class="d-flex flex-column justify-content-end mr-2" style="height:100%;">
                                    <h3 class="card-counter-title mb-0 font-weight-bold transparency">Clicks</h3>
                                    <span class="card-counter font-weight-bold transparency">{{ $parent.listing['ranking']['clicks']}}</span>
                                </div>
                                <div class="d-flex flex-column justify-content-end" style="height:100%; width:22px;">
                                    <img class="tw-w-6 tw-h-6 tw-shadow tw-mr-2" :src="'/img/flags/'+$parent.listing.language+'.svg'" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <span v-if="$parent.isCurrentPage('profile')">
                            <div id="description" class="profile-block markdown tw-py-4">
                                <div class="tw-px-10 mt-4">
                                        <h3 class="heading mb-4 tw-font-bold heading-underline tw-tracking-tighter">Introduction</h3>
                                        <div class="row no-gutters">
                                            <div class="tw-tracking-normal tw-whitespace-pre-wrap markdown-compiled" v-html="$parent.description"></div>
                                        </div>
                                </div>
                            </div>

                            <section id="previews">
                                <div class="tw-px-10 pt-4 pb-3">
                                    <h3 class="heading mb-4 tw-font-bold heading-underline tw-tracking-tighter">Specifications</h3>
                                    <div class="tw-my-0 w-flex">
                                        <carousel-3d :count="$parent.screenshots.length" :height="240" :width="426" :controls-visible="true">
                                            <slide v-for="(screenshot, i) in $parent.screenshots" :index="i" :key="i">
                                                <template slot-scope="{ index, isCurrent, leftIndex, rightIndex }">
                                                    <img :data-index="index" :class="{ current: isCurrent, onLeft: (leftIndex >= 0), onRight: (rightIndex >= 0) }" :src="space+screenshot">
                                                </template>
                                            </slide>
                                        </carousel-3d>
                                    </div>
                                </div>
                            </section>

                            <section id="configuration-details" class="content-block configuration">
                                <div class="tw-px-10 py-4">
                                    <div class="tw-flex tw-flex-row tw--mx-2">
                                        <div class="list tw-w-1/2 tw-flex tw-flex-col tw-mx-2 mb-3">
                                            <div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
                                                <p class="tw-font-bold">Gameplay</p>
                                            </div>
                                            <div class="config">
                                                <div class="name">{{ $t('profile.config.max_base_level.name') }}</div>
                                                <div class="value">{{ $parent.listing.config.max_base_level.toLocaleString()}}</div>
                                            </div>
                                            <div class="config">
                                                <div class="name">{{ $t('profile.config.max_job_level.name') }}</div>
                                                <div class="value">{{ $parent.listing.config.max_job_level.toLocaleString()}}</div>
                                            </div>
                                            <div class="config">
                                                <div class="name">{{ $t('profile.config.base_exp_rate.name') }}</div>
                                                <div class="value">{{ $parent.listing.config.base_exp_rate.toLocaleString()}} <span class="tw-text-gray-600">x</span></div>
                                            </div>
                                            <div class="config">
                                                <div class="name">{{ $t('profile.config.job_exp_rate.name') }}</div>
                                                <div class="value">{{ $parent.listing.config.job_exp_rate.toLocaleString()}} <span class="tw-text-gray-600">x</span></div>
                                            </div>
                                            <div class="config">
                                                <div class="name">{{ $t('profile.config.quest_exp_rate.name') }}</div>
                                                <div class="value">{{ $parent.listing.config.quest_exp_rate.toLocaleString()}} <span class="tw-text-gray-600">x</span></div>
                                            </div>
                                        </div>
                                        <div class="list tw-w-1/2 tw-flex tw-flex-col tw-mx-2 mb-3">
                                            <div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
                                                <p class="tw-font-bold">Battle</p>
                                            </div>
                                            <div class="config">
                                                <div class="name">
                                                    {{ $t('profile.config.instant_cast.name') }}
                                                    <at-popover trigger="hover" :content="$t('profile.config.instant_cast.describe')" placement="right">
                                                        <small class="help-tooltip">[?]</small>
                                                    </at-popover>
                                                </div>
                                                <div class="value">{{ $parent.listing.config.instant_cast_stat === 1 ? 'Yes' : 'No' }}</div>
                                            </div>
                                            <div class="config">
                                                <div class="name">
                                                    {{ $t('profile.config.pk_mode.name') }}
                                                    <at-popover trigger="hover" :content="$t('profile.config.pk_mode.describe')" placement="right">
                                                        <small class="help-tooltip">[?]</small>
                                                    </at-popover>
                                                </div>
                                                <div class="value">{{ $parent.listing.config.pk_mode === 1 ? 'Yes' : 'No'  }}</div>
                                            </div>
                                            <div class="config">
                                                <div class="name">
                                                    {{ $t('profile.config.arrow_decrement.name') }}
                                                <at-popover trigger="hover" :content="$t('profile.config.arrow_decrement.describe')" placement="right">
                                                        <small class="help-tooltip">[?]</small>
                                                    </at-popover>
                                                </div>
                                                <div class="value">{{ $parent.listing.config.arrow_decrement === 1 ? 'Yes' : 'No'  }}</div>
                                            </div>
                                            <div class="config">
                                                <div class="name">
                                                    {{ $t('profile.config.undead_detect_type.name') }}
                                                    <at-popover trigger="hover" :content="$t('profile.config.undead_detect_type.describe')" placement="right">
                                                        <small class="help-tooltip">[?]</small>
                                                    </at-popover>
                                                </div>
                                                <div class="value">{{ $parent.listing.config.undead_detect_type === 1 ? 'Yes' : 'No'  }}</div>
                                            </div>
                                            <div class="config">
                                                <div class="name">
                                                    {{ $t('profile.config.attribute_recover.name') }}
                                                    <at-popover trigger="hover" :content="$t('profile.config.attribute_recover.describe')" placement="right">
                                                        <small class="help-tooltip">[?]</small>
                                                    </at-popover>
                                                </div>
                                                <div class="value">{{ $parent.listing.config.attribute_recover === 1 ? 'Yes' : 'No'  }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tw-flex tw-flex-col tw--mx-2">
                                        <div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
                                            <p class="tw-font-bold tw-capitalize">Drop Rates</p>
                                        </div>
                                        <div class="tw-flex">
                                            <div class="list tw-w-1/2 tw-flex tw-flex-col tw-mx-2 mb-3">
                                                <div class="config">
                                                    <div class="name">{{ $t('profile.config.item_drop_common.name') }}</div>
                                                    <div class="value">{{ $parent.listing.config.item_drop_common.toLocaleString()}} <span class="tw-text-gray-600">x</span></div>
                                                </div>
                                                <div class="config">
                                                    <div class="name">{{ $t('profile.config.item_drop_equip.name') }}</div>
                                                    <div class="value">{{ $parent.listing.config.item_drop_equip.toLocaleString()}} <span class="tw-text-gray-600">x</span></div>
                                                </div>
                                                <div class="config">
                                                    <div class="name">{{ $t('profile.config.item_drop_card.name') }}</div>
                                                    <div class="value">{{ $parent.listing.config.item_drop_card.toLocaleString()}} <span class="tw-text-gray-600">x</span></div>
                                                </div>
                                            </div>
                                            <div class="list tw-w-1/2 tw-flex tw-flex-col tw-mx-2 mb-3">
                                                <div class="config">
                                                    <div class="name">{{ $t('profile.config.item_drop_common_mvp.name') }}</div>
                                                    <div class="value">{{ $parent.listing.config.item_drop_common_mvp.toLocaleString()}} <span class="tw-text-gray-600">x</span></div>
                                                </div>
                                                <div class="config">
                                                    <div class="name">{{ $t('profile.config.item_drop_equip_mvp.name') }}</div>
                                                    <div class="value">{{ $parent.listing.config.item_drop_equip_mvp.toLocaleString()}} <span class="tw-text-gray-600">x</span></div>
                                                </div>
                                                <div class="config">
                                                    <div class="name">{{ $t('profile.config.item_drop_card_mvp.name') }}</div>
                                                    <div class="value">{{ $parent.listing.config.item_drop_card_mvp.toLocaleString()}} <span class="tw-text-gray-600">x</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                <div v-if="reviews && reviews.length > 0" class="tw-px-10 tw-py-4">
                    <h3 class="heading mb-4 tw-font-bold heading-underline tw-tracking-tighter">Review Scoring</h3>
                    <div class="tw-flex tw-flex-row">
                        <div class="tw-flex-1 tw-flex tw-flex-col tw-justify-between tw-pr-6 tw-border-r tw-border-gray-300">
                            <h2 class="tw-font-bold tw-text-center">Average Rating</h2>
                            <div class="">
                                <p class="tw-text-6xl tw-text-center">{{ $parent.listing.review_score.toFixed(1) }}</p>
                                <p class="tw-text-gray-500 tw-text-sm tw-text-center tw-font-semibold">{{ reviews.length }} reviews</p>
                            </div>
                        <div class="tw-flex tw-py-4">
                            <a :href="'/listing/'+slug+'/reviews/create'" class="tw-flex-1 tw-mx-2 at-btn tw-flex-1 tw-mx-2 at-btn--primary at-btn--small at-btn--primary--hollow">Write Review</a>
                            <a :href="'/listing/'+slug+'/reviews'" class="tw-flex-1 tw-mx-2 at-btn tw-flex-1 tw-mx-2 at-btn--primary at-btn--small">Read Reviews</a>
                        </div>
                        </div>
                        <div class="tw-flex-1 tw-pl-6">
                            <h2 class="tw-font-bold" style="margin-bottom: 15px;">Review Breakdowns:</h2>
                            <div class="tw-mb-2">
                                <div class="tw-flex tw-justify-between tw-font-semibold">
                                    <p>Excellent</p>
                                    <p>{{ breakdown["5"] }}%</p>
                                </div>
                                <div class="progress">
                                    <div :class="'bg-'+$parent.accent+'-base'" class="progress-bar" role="progressbar" :style="'width:'+breakdown[5]+'%'" :aria-valuenow="breakdown[5]" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="tw-mb-2">
                                <div class="tw-flex tw-justify-between tw-font-semibold">
                                    <p>Good</p>
                                    <p>{{ breakdown["4"] }}%</p>
                                </div>
                                <div class="progress">
                                    <div :class="'bg-'+$parent.accent+'-base'" class="progress-bar" role="progressbar" :style="'width:'+breakdown[4]+'%'" :aria-valuenow="breakdown[4]" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="tw-mb-2">
                                <div class="tw-flex tw-justify-between tw-font-semibold">
                                    <p>Ok</p>
                                    <p>{{ breakdown["3"] }}%</p>
                                </div>
                                <div class="progress">
                                    <div :class="'bg-'+$parent.accent+'-base'" class="progress-bar" role="progressbar" :style="'width: '+breakdown[3]+'%'" :aria-valuenow="breakdown[3]" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="tw-mb-2">
                                <div class="tw-flex tw-justify-between tw-font-semibold">
                                    <p>Bad</p>
                                    <p>{{ breakdown["2"] }}%</p>
                                </div>
                                <div class="progress">
                                    <div :class="'bg-'+$parent.accent+'-base'" class="progress-bar" role="progressbar" :style="'width: '+breakdown[2]+'%'" :aria-valuenow="breakdown[2]" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="tw-mb-2">
                                <div class="tw-flex tw-justify-between tw-font-semibold">
                                    <p>Terrible</p>
                                    <p>{{ breakdown["1"] }}%</p>
                                </div>
                                <div class="progress">
                                    <div :class="'bg-'+$parent.accent+'-base'" class="progress-bar" role="progressbar" :style="'width: '+breakdown[1]+'%'" :aria-valuenow="breakdown[1]" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else class="tw-px-10">
                    <h3 class="heading mb-4 tw-font-bold heading-underline tw-tracking-tighter">Review Scoring</h3>
                    <span v-if="$parent.listing.slug === 'defaults'">
                        <div class="tw-flex tw-items-center review-enticement-img"></div>
                    </span>
                    <span v-else>
                        <a :href="'/listing/'+slug+'/reviews/create'" v-if="$parent.listing.slug !== 'defaults'">
                            <div class="tw-flex tw-items-center review-enticement-img"></div>
                        </a>
                    </span>

                </div>

                    <!-- View scoreboards/ratings -->
                    <section id="ratings">
                        <div class="tw-px-10">
                            <div class="py-3 mb-3 rounded" style="border:1px solid rgba(255, 255, 255, 0.2);">
                                <h3 class="heading mb-4 tw-font-bold heading-underline tw-tracking-tighter">Balance Ratings</h3>
                                <div class="row no-gutters">
                                    <div class="d-flex">
                                        <scoreboard title="Donations" description="Non-Donators can compete with Donators." :score="avg_donation_score"></scoreboard>
                                        <scoreboard title="Updates" description="Improvements made each update." :score="avg_update_score"></scoreboard>
                                        <scoreboard title="Classes" description="Classes are balanced against other classes." :score="avg_class_score"></scoreboard>
                                        <scoreboard title="Items" description="Item stats are fair and well thought out." :score="avg_item_score"></scoreboard>
                                    </div>
                                </div>
                            </div>
                            <div class="py-3 mb-3 rounded" style="border:1px solid rgba(255, 255, 255, 0.2)">
                                <h3 class="heading mb-4 tw-font-bold heading-underline tw-tracking-tighter">Server Ratings</h3>
                                <div class="row no-gutters">
                                    <div class="d-flex">
                                        <scoreboard title="Support" description="Staff helpfulness on fixing server and player issues" :score="avg_donation_score"></scoreboard>
                                        <scoreboard title="Hosting" description="The availability and ping is playable and fun." :score="avg_hosting_score"></scoreboard>
                                        <scoreboard title="Content" description="There is much to do and progress upon." :score="avg_content_score"></scoreboard>
                                        <scoreboard title="Events" description="Rewards are good and events are regular." :score="avg_event_score"></scoreboard>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </span>
            </div>
        </div>
</template>

<script>
    import {Carousel3d, Slide} from 'vue-carousel-3d';
    import meanBy from 'lodash/meanBy';
    import Scoreboard from '../ScoreboardComponent';

    export default {
    	props: ['review-score', 'slug', 'reviews', 'space', 'breakdown'],
        components: {
            Slide,
            Carousel3d,
            Scoreboard,
        },
        computed: {
            avg_donation_score(){ return this.average('donation_score'); },
            avg_update_score()  { return this.average('update_score');   },
            avg_class_score()   { return this.average('class_score');    },
            avg_item_score()    { return this.average('item_score');     },
            avg_support_score() { return this.average('support_score');  },
            avg_hosting_score() { return this.average('hosting_score');  },
            avg_content_score() { return this.average('content_score');  },
            avg_event_score()   { return this.average('event_score');    },
        },
        methods: {
            average(element) {
                if (this.reviews && this.reviews.length > 0) {
                    return Math.round(meanBy(this.reviews, function(item) {
                        return item[element];
                    }));
                }
            },
        }
    }
</script>
