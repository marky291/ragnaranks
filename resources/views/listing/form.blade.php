@extends('layouts.frame')

@section('content')
	<div class="shadow-inner">
		<div class="container pt-4">
			<profile-page slug="{{ $slug }}" inline-template>
				<div class="row pb-5 pt-2">
					<div id="sidebar" class="col-4">
						@component('layouts.sidebar')
							<div class="tw-h-full">
								<configs inline-template>
									<at-collapse accordion value="details" style="overflow:visible">
										<at-collapse-item name="details">
											<div slot="title">🔨 Initial Card Setup</div>
											<div :class="'bg-'+$parent.listing.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
												<p class="tw-font-bold">Card Design</p>
											</div>
											<div class="tw-p-2">
												<p class="tw-font-semibold tw-mb-1">Server Name</p>
												<at-input v-model="$parent.listing.name" size="small" placeholder="Please input"></at-input>
											</div>
											<div class="tw-p-2">
												<p class="tw-font-semibold tw-mb-1">Accent Color</p>
												<at-select v-model="$parent.listing.accent" class="tw-capitalize">
													<at-option v-for="(accent,i) in accents" :label="accent" :key="i" :value="accent" class="tw-items-center">@{{ accent }}
														<div class="tw-flex-1 tw-flex tw-flex-row">
															<div class="tw-h-4 tw-w-2 tw-flex-1" :class="'bg-'+accent+'-lightest'"></div>
															<div class="tw-h-4 tw-w-2 tw-flex-1" :class="'bg-'+accent+'-light'"></div>
															<div class="tw-h-4 tw-w-2 tw-flex-1" :class="'bg-'+accent+'-base'"></div>
															<div class="tw-h-4 tw-w-2 tw-flex-1" :class="'bg-'+accent+'-dark'"></div>
															<div class="tw-h-4 tw-w-2 tw-flex-1" :class="'bg-'+accent+'-darkest'"></div>
														</div>
													</at-option>
												</at-select>
											</div>
											<div class="tw-p-2">
												<p class="tw-font-semibold tw-mb-1">Nationality</p>
												<div class="tw-flex">
													<at-select v-model="$parent.listing.language" class="tw-capitalize">
														<at-option v-for="(language, i) in languages" :key="i" :value="language.name" :label="language.name"><img class="tw-w-4 tw-h-4 tw-mr-2" :src="'/img/flags/'+language.name+'.svg'" alt=""></i> @{{ language.name }}</at-option>
													</at-select>
												</div>
											</div>
											<div class="tw-p-2">
												<p class="tw-font-semibold tw-flex tw-justify-between tw-mb-1">Background <small class="tw-text-blue">(Optimal size 728x350px)</small></p>
												<at-input v-model="$parent.listing.background" placeholder="Enter an Image URL"></at-input>
											</div>
											<div :class="'bg-'+$parent.listing.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1 tw-mt-3">
												<p class="tw-font-bold">Filtering</p>
											</div>
											<div class="tw-p-2">
												<p class="tw-font-semibold tw-mb-1">Search Tags</p>
												<at-select v-model="$parent.listing.tags" multiple>
													<at-option v-for="tag in tags" v-bind:key="tag['id']" :value="tag['name']">@{{ tag['name'] }}</at-option>
												</at-select>
											</div>
											<div :class="'bg-'+$parent.listing.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1 tw-mt-3">
												<p class="tw-font-bold">Images</p>
											</div>
											<div class="tw-p-2">
												<div class="tw-flex tw-flex-row tw-justify-around">
													<p class="tw-flex-1 tw-font-semibold tw-mb-1">Screenshots</p>
													<div class="tw-flex-1 tw-text-right help-block invalid-feedback">@{{ validation.firstError('screenshot') }}</div>
												</div>
												<div class="tw-flex tw-flex-row">
													<at-input @keyup.enter.native="addScreenshot" :status="validation.hasError('screenshot') ? 'error' : ''" icon="link" type="url" v-model="screenshot" class="tw-flex-1 tw-mr-2" placeholder="Enter an Image URL"></at-input>
													<at-button :disabled="validation.hasError('screenshot')" @click="addScreenshot" type="primary" icon="icon-plus"></at-button>
												</div>
												<span v-for="(screenshot, i) in $parent.listing.screenshots">
												<span class="tw-flex tw-flex-row tw-mb-2">
													<at-button @click="removeScreenshot(i)" size="small" icon="icon-trash-2 tw-text-red" class="tw-mr-2" circle></at-button>
													<at-input size="small" :placeholder="screenshot" class="tw-flex-1" disabled></at-input>
												</span>
											</span>
											</div>
											<div :class="'bg-'+$parent.listing.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1 tw-mt-3">
												<p class="tw-font-bold">Content</p>
											</div>
											<div class="tw-p-2">
												<p class="tw-font-semibold tw-mt-2 tw-mb-3 tw-flex tw-justify-between">Description <small><a class="tw-underline" href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet">MarkDown Syntax Guide</a></small></p>
												<at-textarea style="margin-left:-.5rem; margin-right:-.5rem;" v-model="$parent.listing.description" min-rows="15" max-rows="25" placeholder="Write something catchy"></at-textarea>
											</div>
										</at-collapse-item>
										<at-collapse-item name="config">
											<div slot="title">🔧 Config File Setup</div>
											<div class="">
												<div class="mb-3 configuration">
													<div class="list">
														<div :class="'bg-'+$parent.listing.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
															<p class="tw-font-bold">Player Configuration Setup</p>
														</div>
														@component('listing.partial.config', ['name' => __('configs.max_base_level.name')])
															<at-input v-model="$parent.listing.configs.max_base_level" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.max_job_level.name')])
															<at-input v-model="$parent.listing.configs.max_job_level" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.max_aspd.name')])
															<at-input v-model="$parent.listing.configs.max_aspd" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.max_stats.name')])
															<at-input v-model="$parent.listing.configs.max_stats" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														<div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
															<p class="tw-font-bold">Experience Points Setup</p>
														</div>
														@component('listing.partial.config', ['name' => __('configs.base_exp_rate.name')])
															<at-input v-model="$parent.listing.configs.base_exp_rate" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.job_exp_rate.name')])
															<at-input v-model="$parent.listing.configs.job_exp_rate" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.quest_exp_rate.name')])
															<at-input v-model="$parent.listing.configs.quest_exp_rate" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														<div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
															<p class="tw-font-bold">Drop Rate Setup</p>
														</div>
														@component('listing.partial.config', ['name' => __('configs.item_drop_common.name')])
															<at-input v-model="$parent.listing.configs.item_drop_common" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.item_drop_equip.name')])
															<at-input v-model="$parent.listing.configs.item_drop_equip" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.item_drop_card.name')])
															<at-input v-model="$parent.listing.configs.item_drop_card" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.item_drop_common_mvp.name')])
															<at-input v-model="$parent.listing.configs.item_drop_common_mvp" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.item_drop_equip_mvp.name')])
															<at-input v-model="$parent.listing.configs.item_drop_equip_mvp" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.item_drop_card_mvp.name')])
															<at-input v-model="$parent.listing.configs.item_drop_card_mvp" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														<div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
															<p class="tw-font-bold">Skill Casting Setup</p>
														</div>
														@component('listing.partial.config', ['name' => __('configs.instant_cast.name')])
															<at-input v-model="$parent.listing.configs.instant_cast" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.castrate_dex_scale.name')])
															<at-input v-model="$parent.listing.configs.castrate_dex_scale" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														<div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
															<p class="tw-font-bold">Battle Setup</p>
														</div>
														@component('listing.partial.config', ['name' => __('configs.arrow_decrement.name')])
															<div class="tw-flex">
																<at-radio v-model="$parent.listing.configs.arrow_decrement" label="No">No</at-radio>
																<at-radio v-model="$parent.listing.configs.arrow_decrement" label="Yes">Yes</at-radio>
															</div>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.undead_detect_type.name')])
															<div class="tw-flex">
																<at-radio v-model="$parent.listing.configs.undead_detect_type" label="No">No</at-radio>
																<at-radio v-model="$parent.listing.configs.undead_detect_type" label="Yes">Yes</at-radio>
															</div>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.attribute_recover.name')])
															<div class="tw-flex">
																<at-radio v-model="$parent.listing.configs.attribute_recover" label="No">No</at-radio>
																<at-radio v-model="$parent.listing.configs.attribute_recover" label="Yes">Yes</at-radio>
															</div>
														@endcomponent
													</div>
													<div class="mb-3 configuration">
														<div class="list">
															<div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1 tw-mb-2">
																<p class="tw-font-bold">List Player Commands</p>
															</div>
															<multiselect v-model="$parent.listing.commands" :hide-selected="true" :close-on-select="false" :show-labels="false" open-direction="bottom" tag-placeholder="Add this Command" placeholder="Type an @Command" label="name" track-by="name" :options="commandChoices" :multiple="true" :taggable="true" @tag="addTag">
																														<template slot="tag" slot-scope="option"><span class="option__desc"><span class="option__title">@{{ option.title }}</span></span></template>
															</multiselect>
														</div>
													</div>
												</div>
											</div>
										</at-collapse-item>
									</at-collapse>
								</configs>
							</div>
						@endcomponent
					</div>
					<div class="col-8">
						<profile inline-template>
							<transition name="fade">
								<div class="" v-if="$parent.profileLoaded">
									<div :class="'use-accent-'+accent" class="mb-3 server-card item flex-fill shadow border rounded">
										<div id="profile-card" class="profile-block">
											<div class="server-card-head image rounded-top" style="height:350px;" v-bind:style="{ backgroundImage: 'url(' + $parent.listing.background + ')' }"></div>
											<div class="server-card-head overlap d-flex" style="margin-top:-169px;">
												<i class="fas fa-arrow-left tw-text-white tw-text-2xl tw-absolute tw-align-top"></i>
												<div class="left-side d-flex w-75 flex-column align-items-start px-4 py-2 align-self-end">
													<h1 class="text-white font-weight-bold mb-0" style="font-size: 24px;">@{{ $parent.listing.name }}</h1>
													<ul class="tag-list list-unstyled d-flex tw-text-xs tw-text-green-light">
														<li class="mr-2" v-for="tag in $parent.listing.tags">#@{{ tag.name }}</li>
{{--														<li class="mr-2" v-if="!listing.tags.length">#TagYourServerFunctionality</li>--}}
													</ul>
												</div>
												<div class="right-side flex-fill d-flex justify-content-end pr-3" style="padding-bottom:12px;">
													<div class="d-flex flex-column justify-content-end mr-3" style="height:100%;">
														<h3 class="card-counter-title mb-0 font-weight-bold transparency text-white">Votes</h3>
														<span class="card-counter font-weight-bold transparency">@{{ $parent.listing.votes }}</span>
													</div>
													<div class="d-flex flex-column justify-content-end mr-2" style="height:100%;">
														<h3 class="card-counter-title mb-0 font-weight-bold transparency text-white">Clicks</h3>
														<span class="card-counter font-weight-bold transparency">@{{ $parent.listing.clicks }}</span>
													</div>
													<div class="d-flex flex-column justify-content-end" style="height:100%;">
														<img class="tw-h-6 tw-w-6 tw-shadow" :src="'/img/flags/'+$parent.listing.language+'.svg'" :alt="flag">
													</div>
												</div>
											</div>
										</div>

										<div class="tw-container mt-4">
											<div id="description" class="profile-block markdown">
												<div class="py-4">
													<div class="row no-gutters">
														<div class="tw-tracking-normal tw-whitespace-pre-wrap markdown-compiled" v-html="markedDescription"></div>
													</div>
												</div>
											</div>
										</div>

										<section data-aos-once="true" id="previews">
											<div class="container px-5 pt-4 pb-3">
												<h3 class="heading mb-4 tw-font-bold heading-underline tw-tracking-tight">Specifications</h3>
												<div class="tw-my-0 w-flex">
													<carousel-3d :count="listing.screenshots.length" :height="220" :width="380" :controls-visible="true" :autoplay="true" :autoplay-timeout="2500">
														<slide v-for="(screenshot, i) in screenshots" :index="i" :key="i">
															<template slot-scope="{ index, isCurrent, leftIndex, rightIndex }">
																<img :data-index="index" :class="{ current: isCurrent, onLeft: (leftIndex >= 0), onRight: (rightIndex >= 0) }" :src="screenshot">
															</template>
														</slide>
													</carousel-3d>
												</div>
											</div>
										</section>

										<section id="configuration-details" class="content-block configuration">
											<div class="container px-5 py-4">
												<h3 class="heading mb-4 tw-font-bold text-dark heading-underline">Server Setup</h3>
												<at-tabs>
													<at-tab-pane label="Configs" name="rates" icon="icon-bar-chart-2">
														<div class="row">
															<div class="list col-4 d-flex flex-column mb-3">
																<div class="tw-mb-3">
																	<div :class="'bg-'+accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
																		<p class="tw-font-bold">Gameplay</p>
																	</div>
																	@component('listing.partial.config', ['name' => __('configs.max_base_level.name'), 'tooltip' => __('configs.max_base_level.describe')])
																		@{{ listing.configs.max_base_level }}
																	@endcomponent
																	@component('listing.partial.config', ['name' => __('configs.max_job_level.name'), 'tooltip' => __('configs.max_job_level.describe')])
																		@{{ listing.configs.max_job_level }}
																	@endcomponent
																	@component('listing.partial.config', ['name' => __('configs.max_aspd.name'), 'tooltip' => __('configs.max_aspd.describe')])
																		@{{ listing.configs.max_aspd }}
																	@endcomponent
																	@component('listing.partial.config', ['name' => __('configs.max_stats.name'), 'tooltip' => __('configs.max_stats.describe')])
																		@{{ listing.configs.max_stats }}
																	@endcomponent
																	@component('listing.partial.config', ['name' => __('configs.base_exp_rate.name'), 'tooltip' => __('configs.base_exp_rate.describe')])
																		@{{ listing.configs.base_exp_rate }}x
																	@endcomponent
																	@component('listing.partial.config', ['name' => __('configs.job_exp_rate.name'), 'tooltip' => __('configs.job_exp_rate.describe')])
																		@{{ listing.configs.job_exp_rate }}x
																	@endcomponent
																	@component('listing.partial.config', ['name' => __('configs.quest_exp_rate.name'), 'tooltip' => __('configs.quest_exp_rate.describe')])
																		@{{ listing.configs.quest_exp_rate }}x
																	@endcomponent
																</div>
															</div>
															<div class="list col-4 d-flex flex-column mb-3">
																<div class="tw-mb-3">
																	<div :class="'bg-'+accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
																		<p class="tw-font-bold">Drops</p>
																	</div>
																	@component('listing.partial.config', ['name' => __('configs.item_drop_common.name'), 'tooltip' => __('configs.item_drop_common.describe')])
																		@{{ listing.configs.item_drop_common }}x
																	@endcomponent
																	@component('listing.partial.config', ['name' => __('configs.item_drop_equip.name'), 'tooltip' => __('configs.item_drop_equip.describe')])
																		@{{ listing.configs.item_drop_equip }}x
																	@endcomponent
																	@component('listing.partial.config', ['name' => __('configs.item_drop_card.name'), 'tooltip' => __('configs.item_drop_card.describe')])
																		@{{ listing.configs.item_drop_card }}x
																	@endcomponent
																	@component('listing.partial.config', ['name' => __('configs.item_drop_common_mvp.name'), 'tooltip' => __('configs.item_drop_common_mvp.describe')])
																		@{{ listing.configs.item_drop_common_mvp }}x
																	@endcomponent
																	@component('listing.partial.config', ['name' => __('configs.item_drop_equip_mvp.name'), 'tooltip' => __('configs.item_drop_equip_mvp.describe')])
																		@{{ listing.configs.item_drop_equip_mvp }}x
																	@endcomponent
																	@component('listing.partial.config', ['name' => __('configs.item_drop_card_mvp.name'), 'tooltip' => __('configs.item_drop_card_mvp.describe')])
																		@{{ listing.configs.item_drop_card_mvp }}x
																	@endcomponent
																</div>
															</div>
															<div class="list col-4 d-flex flex-column mb-3">
																<div class="tw-mb-3">
																	<div :class="'bg-'+accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
																		<p class="tw-font-bold">Other</p>
																	</div>
																	@component('listing.partial.config', ['name' => __('configs.instant_cast.name'), 'tooltip' => __('configs.instant_cast.describe')])
																		@{{ listing.configs.instant_cast }}
																	@endcomponent
																	@component('listing.partial.config', ['name' => __('configs.episode.name'), 'tooltip' => __('configs.episode.describe')])
																		@{{ listing.configs.episode }}
																	@endcomponent
																	@component('listing.partial.config', ['name' => __('configs.pk_mode.name'), 'tooltip' => __('configs.pk_mode.describe')])
																		@{{ listing.configs.pk_mode }}
																	@endcomponent
																	@component('listing.partial.config', ['name' => __('configs.arrow_decrement.name'), 'tooltip' => __('configs.arrow_decrement.describe')])
																		@{{ listing.configs.arrow_decrement }}
																	@endcomponent
																	@component('listing.partial.config', ['name' => __('configs.undead_detect_type.name'), 'tooltip' => __('configs.undead_detect_type.describe')])
																		@{{ listing.configs.undead_detect_type }}
																	@endcomponent
																	@component('listing.partial.config', ['name' => __('configs.attribute_recover.name'), 'tooltip' => __('configs.attribute_recover.describe')])
																		@{{ listing.configs.attribute_recover}}
																	@endcomponent
																</div>
															</div>
														</div>
													</at-tab-pane>
													<at-tab-pane label="Comamnds" name="commands" icon="icon-target">
														<div class="list">
															<div :class="'bg-'+accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
																<p class="tw-font-bold">Notable Player Commands</p>
															</div>
															<div class="tw-flex-1 tw-flex tw-flex-wrap tw-overflow-scroll" style="max-height:270px;">
																<div v-for="(command, i) in listing.commands" :key="i" class="config tw-w-1/3 px-2 py-2 d-flex flex-row tw-items-center">
																	<p class="text-dark font-weight-bold flex-fill">@{{ command.name }}</p>
																	<at-popover trigger="hover" class="tw-mr-2" :content="command.description" placement="right">
																		<p><i class="icon icon-info"></i></p>
																	</at-popover>
																</div>
															</div>
														</div>
													</at-tab-pane>
													<at-tab-pane label="Features" name="features" icon="icon-award">
														<div class="tw-flex list">
															<div class="tw-flex-1">
																<div :class="'bg-'+accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
																	<p class="tw-font-bold">Notable Server Features</p>
																</div>
																<div v-for="(command, i) in _.take(listing.commands, 12)" :key="i" class="config px-2 py-2 d-flex flex-row tw-items-center">
																	<p class="text-dark font-weight-bold flex-fill">@{{ feature.name }}</p>
																	<p class="text-muted mb-0">@{{ feature.description }}</p>
																</div>
															</div>
														</div>
													</at-tab-pane>
												</at-tabs>
											</div>
										</section>

										<section id="ratings">
											<div class="container pl-5 pr-5">
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
										WE USE BOTH CREATING AND VIEWING ON THIS FORM. CHECK WHICH ONE
										@if (false)
											<section id="reviews">
												<div class="container px-5 py-4">
													<h3 class="heading mb-4 tw-font-bold text-dark heading-underline">Player Reviews</h3>

													<reviews :data="{{ $listing->reviews->load('publisher') }}" inline-template>
														<div class="">
															<div v-for="(review, index) in collection">
																<review :review="review" inline-template>
																	<div class="review tw-mb-4 tw-p-3">
																		<div class="row no-gutters">
																			<div class="col bg-white pb-3 content">
																				<div class="tw-flex mb-3 tw-items-center">
																					<div class="tw-rounded-full tw-h-16 tw-w-16 tw-flex tw-avatar-circle tw-items-center tw-justify-center tw-mr-3 tw-bg-grey">
																						<img class="border hover:tw-border-solid hover:tw-border-grey hover:tw-shadow tw-rounded-full tw-avatar-circle" :src="review.publisher.avatarUrl" alt="">
																					</div>
																					<div class="tw-flex tw-flex-row tw-flex-1 tw-text-left">
																						<div class="info d-flex tw-flex-col tw-flex mb-1">
																							<p class="tw-flex-1 tw-text-lg tw-text-grey-darkest tw-font-semibold tw-mb-0">@{{ review.publisher.username }}</p>
																							<p>Member since @{{ memberSinceDate() }}</p>
																						</div>
																						<div class="tw-flex tw-flex-col tw-text-right tw-flex-1">
																							Rating: @{{ averageRating }} (@{{ averageScore }})
																							<p class="tw-flex-1">Posted @{{ formattedDate() }}</p>
																						</div>
																					</div>
																				</div>
																				<div class="description">
																					<p class="tw-text-grey-dark">@{{ review.message }}</p>
																				</div>
																				<div class="tw-border-red tw-p-2 tw-mt-2 tw-bg-red-lightest tw-rounded" v-for="(comment, index) in review.comments">
																					<p class="tw-font-semibold">Reply from owner</p>
																					<p class="tw-text-red">@{{ comment.message }}</p>
																				</div>
																				<div v-show="viewingDetails" class="tw-flex tw-border-t tw-border-grey-light py-3 mt-3">
																					<ul class="tw-flex-1 mb-0">
																						<li class="tw-text-xs"><b>Donation Score</b>: @{{ review.donation_score }}</li>
																						<li class="tw-text-xs"><b>Update Score</b>: @{{ review.update_score }}</li>
																					</ul>
																					<ul class="tw-flex-1 mb-0">
																						<li class="tw-text-xs"><b>Classes Score</b>: @{{ review.class_score }}</li>
																						<li class="tw-text-xs"><b>Items Score</b>: @{{ review.item_score }}</li>
																					</ul>
																					<ul class="tw-flex-1 mb-0">
																						<li class="tw-text-xs"><b>Support Score</b>: @{{ review.support_score }}</li>
																						<li class="tw-text-xs"><b>Hosting Score</b>: @{{ review.hosting_score }}</li>
																					</ul>
																					<ul class="tw-flex-1 mb-0">
																						<li class="tw-text-xs"><b>Content Score</b>: @{{ review.content_score }}</li>
																						<li class="tw-text-xs"><b>Events Score</b>: @{{ review.event_score }}</li>
																					</ul>
																				</div>
																				<div v-show="commenting" class="tw-mt-3">
																					<p class="tw-text-red tw-font-semibold">Comment on this review as server owner</p>
																					<at-textarea v-model="comment.message" min-rows="5" class="tw-mt-2" autosize placeholder="Write your reply towards this review"></at-textarea>
																					<has-error :form="comment" field="message"></has-error>
																					<at-button @click="postComment" type="error" class="tw-mt-2">Post Comment</at-button>
																				</div>
																				<div class="tw-flex tw-justify-end">
																					<at-button @click="viewingDetails = !viewingDetails" icon="icon-maximize-2" type="text">@{{ detailButtonText }}</at-button>
																					<at-button @click="reportReview" icon="icon-flag" type="text">Report</at-button>
																					<at-button v-if="!review.comments.length" @click="commenting = !commenting" icon="icon-paperclip" type="text">@{{ commentButtonText }}</at-button>
																				</div>
																			</div>
																		</div>
																	</div>
																</review>
															</div>

															<div id="comment-reply" class="tw-mt-4 create-reply tw-flex tw-items-center rounded tw-cursor-pointer">
																<div class="tw-p-4 tw-flex tw-w-full tw-items-center">
							<span id="reply-action" class="tw-w-full">
								<div class="row">
									<div class="py-3">
										<h3 class="heading tw-mb-1 tw-font-bold text-dark mb-4 heading-underline">You are creating a <span class="tw-text-blue">Review</span></h3>
										<p class="tw-text-grey-dark mb-4">Focus on being factual and objective. Don't use aggressive language and don't post personal details...</p>
										<at-textarea ref="textarea" v-model="review.message" min-rows="8" autosize placeholder="Your experience, Your review"></at-textarea>
										<has-error :form="review" field="message"></has-error>
									</div>
									<div class="row tw-mb-5">
										<div class="col-6">
											<div class="tw-p-2 tw-rounded tw-mb-4">
												<p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Donations</p>
												<p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience against non-donators on the server?</p>
												<at-rate :show-text="true" :count="5" v-model="review.donation_score" class="tw-flex">
													<p class="tw-font-bold">@{{ ratingScore(review.donation_score) }}</p>
												</at-rate>
											</div>

											<div class="tw-p-2 tw-rounded tw-mb-4">
												<p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Updates</p>
												<p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the updates and their effects on the server?</p>
												<at-rate :show-text="true" :count="5" v-model="review.update_score" class="tw-flex">
													<p class="tw-font-bold">@{{ ratingScore(review.update_score) }}</p>
												</at-rate>
											</div>

											<div class="tw-p-2 tw-rounded tw-mb-4">
												<p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Class Experience</p>
												<p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the class diversity and balance on the server?</p>
												<at-rate :show-text="true" :count="5" v-model="review.class_score" class="tw-flex">
													<p class="tw-font-bold">@{{ ratingScore(review.class_score) }}</p>
												</at-rate>
											</div>

											<div class="tw-p-2 tw-rounded tw-mb-4">
												<p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Custom Items</p>
												<p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the item balance and customization on the server?</p>
												<at-rate :show-text="true" :count="5" v-model="review.item_score" class="tw-flex">
													<p class="tw-font-bold">@{{ ratingScore(review.item_score) }}</p>
												</at-rate>
											</div>
										</div>
										<div class="col-6">

											<div class="tw-p-2 tw-rounded tw-mb-4">
												<p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Staff Support</p>
												<p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience of reaching the Staff and their support of the server?</p>
												<at-rate :show-text="true" :count="5" v-model="review.support_score" class="tw-flex">
													<p class="tw-font-bold">@{{ ratingScore(review.support_score) }}</p>
												</at-rate>
											</div>

											<div class="tw-p-2 tw-rounded tw-mb-4">
												<h4 class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Server Latency</h4>
												<p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the latency on the server?</p>
												<at-rate :show-text="true" :count="5" v-model="review.hosting_score" class="tw-flex">
													<p class="tw-font-bold">@{{ ratingScore(review.hosting_score) }}</p>
												</at-rate>
											</div>

											<div class="tw-p-2 tw-rounded tw-mb-4">
												<h4 class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Custom Content</h4>
												<p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the overall customization of the server?</p>
												<at-rate :show-text="true" :count="5" v-model="review.content_score" class="tw-flex">
													<p class="tw-font-bold">@{{ ratingScore(review.content_score) }}</p>
												</at-rate>
											</div>

											<div class="tw-p-2 tw-rounded tw-mb-4">
												<h4 class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Events</h4>
												<p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the eventfullness of automated and/or GM hosted events on the server?</p>
												<at-rate :show-text="true" :count="5" v-model="review.event_score" class="tw-flex">
													<p class="tw-font-bold">@{{ ratingScore(review.event_score) }}</p>
												</at-rate>
											</div>
										</div>
									</div>
								</div>
								<at-button @click="postReview('{{ route('listing.reviews.store', $listing) }}')" type="primary" class="flex-fill">Post my Review!</at-button>
								<at-button @click="$parent.setView('listing')" type="info" hollow>Maybe I will create one later!</at-button>
							</span>
																</div>
															</div>
														</div>
													</reviews>
												</div>
											</section>
											<span>
										@component('listing.partial.wrapper', ['view' => 'voting','heading' => "You are voting for $listing->name"])
													<p class="tw-font-bold mb-3 tw-text-green">You have (1) vote remaining!</p>
													<p class="mb-3">Your vote will have a cooling period of <b>{{ config('interaction.vote.spread') }} hours</b>, this cannot be returned and will remain on {{ $listing->name }} for 7 days starting from the time and date of your cast</p>
													<at-button type="primary" icon="icon-log-out" class="mt-2">Vote for {{ $listing->name }}</at-button>
												@endcomponent
									</span>
										@endif
									</div>
								</div>
							</transition>
						</profile>
					</div>
				</div>
			</profile-page>
		</div>
	</div>
@endsection
