<template>
        <div class="tw-shadow" v-if="$parent.profileLoaded">
            <div :class="'use-accent-'+$parent.listing.accent" class="mb-3 server-card item flex-fill border rounded">
                <div id="profile-card" class="profile-block">
                    <div class="server-card-head-large image rounded-top" style="height:350px;" v-bind:style="{ backgroundImage: 'url(' + space + $parent.listing.background + ')' }"></div>
                    <div class="server-card-head-large hover:tw-bg-transparent tw-cursor-pointer overlap tw-flex tw-flex-col tw-justify-between" style="margin-top:-350px;">
                        <div class="tw-text-right">
                            <div v-if="$parent.listing.heartbeat.recorder != 'none'" class="tw-shadow tw-inline-block tw-px-3 tw-py-1 tw-rounded-l" style="font-size:9px; background-color: rgba(247, 247, 247, 1)">
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
                                <div class="d-flex flex-column justify-content-end" style="height:100%;">
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

                        <!-- Show reviews -->
                            <keep-alive>
                                <reviews :reviews="reviews"></reviews>
                            </keep-alive>

                        <!-- View scoreboards/ratings -->
                            <keep-alive>
                                <ratings :reviews="reviews"></ratings>
                            </keep-alive>

                        </span>

                <!-- Create a review -->
                <transition name="fade">
                    <keep-alive>
                        <review-creator @review:created="$parent.pushNewReview" v-if="$parent.isCurrentPage('reviewing')" :listing-slug="slug"></review-creator>
                    </keep-alive>
                </transition>

                <!-- Voting View -->
                <transition name="fade">
                    <keep-alive>
                        <voting @vote:created="$parent.incrementVote(1)" v-if="$parent.isCurrentPage('voting')" :listing-name="$parent.listing.name" :listing-slug="slug"></voting>
                    </keep-alive>
                </transition>
            </div>
        </div>
</template>

<script>
    import {Carousel3d, Slide} from 'vue-carousel-3d';
    import Reviews from '../ReviewsComponent';
    import ReviewCreator from '../profile/ProfileReviewCreator';
    import Ratings from '../profile/RatingsComponent';
    import Voting from '../profile/ProfileVoting';

    export default {
    	props: ['slug', 'reviews', 'space'],
        components: {
            Slide,
            Reviews,
            ReviewCreator,
            Carousel3d,
            Ratings,
            Voting,
        },
    }
</script>
