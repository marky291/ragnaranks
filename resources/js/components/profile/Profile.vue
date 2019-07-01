<template>
    <transition name="fade">
        <div class="" v-if="$parent.profileLoaded">
            <div :class="'use-accent-'+$parent.accent" class="mb-3 server-card item flex-fill border rounded">

                <div id="profile-card" class="profile-block">
                    <div class="server-card-head image rounded-top" style="height:350px;" v-bind:style="{ backgroundImage: 'url(' + $parent.background + ')' }"></div>
                    <div class="server-card-head overlap d-flex" style="margin-top:-169px;">
                        <i class="fas fa-arrow-left tw-text-white tw-text-2xl tw-absolute tw-align-top"></i>
                        <div class="left-side d-flex w-75 flex-column align-items-start px-4 py-2 align-self-end">
                            <h1 class="text-white font-weight-bold mb-0" style="font-size: 26px; color:rgb(243, 243, 243);">{{ $parent.listing.name }}</h1>
                            <ul class="tag-list list-unstyled d-flex tw-text-xs tw-text-green-light" style="font-size:13px;">
                                <li class="mr-2" v-for="tag in $parent.listing.tags">#{{ tag }}</li>
                                <li class="mr-2" v-if="!$parent.listing.tags.length">#TagYourServerFunctionality</li>
                            </ul>
                        </div>
                        <div class="right-side flex-fill d-flex justify-content-end pr-3" style="padding-bottom:12px;">
                            <div class="d-flex flex-column justify-content-end mr-3" style="height:100%;">
                                <h3 class="card-counter-title mb-0 font-weight-bold transparency">Votes</h3>
                                <span class="card-counter font-weight-bold transparency">{{ $parent.listing.ranking.votes }}</span>
                            </div>
                            <div class="d-flex flex-column justify-content-end mr-2" style="height:100%;">
                                <h3 class="card-counter-title mb-0 font-weight-bold transparency">Clicks</h3>
                                <span class="card-counter font-weight-bold transparency">{{ $parent.listing.ranking.clicks }}</span>
                            </div>
                            <div class="d-flex flex-column justify-content-end" style="height:100%;">
                                <img class="tw-h-6 tw-w-6 tw-shadow" :src="'/img/flags/'+$parent.listing.language+'.svg'" alt="flag">
                            </div>
                        </div>
                    </div>
                </div>

                <span v-if="$parent.isCurrentPage('profile')">
											<div class="tw-px-10 mt-4">
												<div id="description" class="profile-block markdown tw-py-4">
													<h3 class="heading mb-4 tw-font-bold heading-underline tw-tracking-tight">Introduction</h3>
													<div class="row no-gutters">
														<div class="tw-tracking-normal tw-whitespace-pre-wrap markdown-compiled" v-html="$parent.description"></div>
													</div>
												</div>
											</div>

											<section id="previews">
												<div class="tw-px-10 pt-4 pb-3">
													<h3 class="heading mb-4 tw-font-bold heading-underline tw-tracking-tight">Specifications</h3>
													<div class="tw-my-0 w-flex">
														<carousel-3d :count="$parent.screenshots.length" :height="220" :width="380" :controls-visible="true">
															<slide v-for="(screenshot, i) in $parent.screenshots" :index="i" :key="i">
																<template slot-scope="{ index, isCurrent, leftIndex, rightIndex }">
																	<img :data-index="index" :class="{ current: isCurrent, onLeft: (leftIndex >= 0), onRight: (rightIndex >= 0) }" :src="screenshot">
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
																<div class="value">{{ $parent.listing.config.max_base_level }}</div>
															</div>
															<div class="config">
																<div class="name">{{ $t('profile.config.max_job_level.name') }}</div>
																<div class="value">{{ $parent.listing.config.max_job_level }}</div>
															</div>
															<div class="config">
																<div class="name">{{ $t('profile.config.base_exp_rate.name') }}</div>
																<div class="value">{{ $parent.listing.config.base_exp_rate}}</div>
															</div>
															<div class="config">
																<div class="name">{{ $t('profile.config.job_exp_rate.name') }}</div>
																<div class="value">{{ $parent.listing.config.job_exp_rate }}</div>
															</div>
															<div class="config">
																<div class="name">{{ $t('profile.config.quest_exp_rate.name') }}</div>
																<div class="value">{{ $parent.listing.config.quest_exp_rate}}</div>
															</div>
														</div>
														<div class="list tw-w-1/2 tw-flex tw-flex-col tw-mx-2 mb-3">
															<div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
																<p class="tw-font-bold">Battle</p>
															</div>
															<div class="config">
																<div class="name">{{ $t('profile.config.instant_cast.name') }}</div>
																<div class="value">{{ $parent.listing.config.instant_cast_stat === 'Yes'? 'Yes' : 'No' }}</div>
															</div>
															<div class="config">
																<div class="name">{{ $t('profile.config.pk_mode.name') }}</div>
																<div class="value">{{ $parent.listing.config.pk_mode === 'Yes'? 'Yes' : 'No'  }}</div>
															</div>
															<div class="config">
																<div class="name">{{ $t('profile.config.arrow_decrement.name') }}</div>
																<div class="value">{{ $parent.listing.config.arrow_decrement === 'Yes'? 'Yes' : 'No'  }}</div>
															</div>
															<div class="config">
																<div class="name">{{ $t('profile.config.undead_detect_type.name') }}</div>
																<div class="value">{{ $parent.listing.config.undead_detect_type === 'Yes'? 'Yes' : 'No'  }}</div>
															</div>
															<div class="config">
																<div class="name">{{ $t('profile.config.attribute_recover.name') }}</div>
																<div class="value">{{ $parent.listing.config.attribute_recover === 'Yes'? 'Yes' : 'No'  }}</div>
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
																	<div class="value">{{ $parent.listing.config.item_drop_common }}</div>
																</div>
																<div class="config">
																	<div class="name">{{ $t('profile.config.item_drop_equip.name') }}</div>
																	<div class="value">{{ $parent.listing.config.item_drop_equip }}</div>
																</div>
																<div class="config">
																	<div class="name">{{ $t('profile.config.item_drop_card.name') }}</div>
																	<div class="value">{{ $parent.listing.config.item_drop_card }}</div>
																</div>
															</div>
															<div class="list tw-w-1/2 tw-flex tw-flex-col tw-mx-2 mb-3">
																<div class="config">
																	<div class="name">{{ $t('profile.config.item_drop_common_mvp.name') }}</div>
																	<div class="value">{{ $parent.listing.config.item_drop_common_mvp }}</div>
																</div>
																<div class="config">
																	<div class="name">{{ $t('profile.config.item_drop_equip_mvp.name') }}</div>
																	<div class="value">{{ $parent.listing.config.item_drop_equip_mvp }}</div>
																</div>
																<div class="config">
																	<div class="name">{{ $t('profile.config.item_drop_card_mvp.name') }}</div>
																	<div class="value">{{ $parent.listing.config.item_drop_card_mvp }}</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</section>

											<section id="ratings">
												<div class="tw-px-10">
													<div class="py-3 mb-3 rounded" style="border:1px solid rgba(255, 255, 255, 0.2);">
														<h3 class="heading mb-4 tw-font-bold heading-underline tw-tracking-tight">Balance Ratings</h3>
														<div class="row no-gutters">
															<scoreboards inline-template>
																<div class="d-flex">
																	<scoreboard title="Donations" description="Non-Donators can compete with Donators." :score="avg_donation_score"></scoreboard>
																	<scoreboard title="Updates" description="Improvements made each update." :score="avg_update_score"></scoreboard>
																	<scoreboard title="Classes" description="Classes are balanced against other classes." :score="avg_class_score"></scoreboard>
																	<scoreboard title="Items" description="Item stats are fair and well thought out." :score="avg_item_score"></scoreboard>
																</div>
															</scoreboards>
														</div>
													</div>
													<div class="py-3 mb-3 rounded" style="border:1px solid rgba(255, 255, 255, 0.2)">
														<h3 class="heading mb-4 tw-font-bold heading-underline tw-tracking-tight">Server Ratings</h3>
														<div class="row no-gutters">
															<scoreboards inline-template>
																<div class="d-flex">
																	<scoreboard title="Support" description="Non-Donators can compete with Donators." :score="avg_support_score"></scoreboard>
																	<scoreboard title="Hosting" description="The availability and ping is playable and fun." :score="avg_hosting_score"></scoreboard>
																	<scoreboard title="Content" description="There is much to do and progress upon." :score="avg_content_score"></scoreboard>
																	<scoreboard title="Events" description="Rewards are good and events are regular." :score="avg_event_score"></scoreboard>
																</div>
															</scoreboards>
														</div>
													</div>
												</div>
											</section>

											<reviews></reviews>
										</span>

                <review-creator v-if="$parent.isCurrentPage('reviewing')"></review-creator>

                <span v-if="$parent.isCurrentPage('voting')">
											<section id="voting" class="content-block mt-4">
												<div class="container px-5 py-4">
													<h3 class="heading tw-font-bold mb-4 text-dark heading-underline">You are voting for x</h3>
													<div class="row no-gutters">
														<p class="tw-font-bold mb-3 tw-text-green">You have (1) vote remaining!</p>
														<p class="mb-3">Your vote will have a cooling period of <b>{{ config('interaction.vote.spread') }} hours</b>, this cannot be returned and will remain on x for 7 days starting from the time and date of your cast</p>
														<at-button type="primary" icon="icon-log-out" class="mt-2">Vote for x</at-button>
													</div>
												</div>
											</section>
										</span>
            </div>
        </div>
    </transition>
</template>

<script>
    import {Carousel3d, Slide} from 'vue-carousel-3d';
    import Reviews from '../ReviewsComponent.vue';
    import ReviewCreator from '../profile/ProfileReviewCreator.vue';
    import Scoreboards from '../ScoreboardsComponent.vue';

    export default {
        components: {
            Slide,
            Reviews,
            ReviewCreator,
            Carousel3d,
            Scoreboards,
        },
        data: function () {
            return {
                reviews: {}
            }
        },
        async mounted() {
            //
        },
        methods: {
            test() {
                console.log('test');
            }
        }
    }
</script>