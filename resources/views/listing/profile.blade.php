@extends('layouts.frame')

@section('content')
	<div class="shadow-inner">
		<div class="container pt-4">
			<profile-page slug="{{ $slug ?? 'defaults' }}" inline-template>
				<div class="row pb-5 pt-2">
					<div id="sidebar" class="col-4">
						@component('layouts.sidebar')
							<div class="tw-h-full tw-mt-4">
								<div class="heading">
									<h3>User Actions</h3>
								</div>
								<div id="user-actions" class="content py-0 rounded py-3 d-flex flex-column">
									<at-button class="mb-2" type="primary" hollow>Back to Searching</at-button>
									<at-button class="mb-2" hollow>Visit Website</at-button>
									<span v-if="!isCurrentPage('voting')">
                                   		<at-button @click="setCurrentPage('voting')" class="w-100 mb-2" hollow>Vote for server</at-button>
                                	</span>
									<span v-else>
                                    	<at-button @click="setCurrentPage('profile')" type="error" class="w-100 mb-2" hollow>Back to Listing</at-button>
                                	</span>
									<span v-if="!isCurrentPage('reviewing')">
                                    	<at-button @click="setCurrentPage('reviewing')" type="success" class="w-100" hollow>Create a review</at-button>
                                	</span>
									<span v-else>
                                    	<at-button @click="setCurrentPage('profile')" type="error" class="w-100" hollow>Back to Listing</at-button>
                                	</span>
								</div>
							</div>
							<div class="tw-h-full mt-4">
								<configs inline-template v-if="listing.isEditor">
									<at-collapse accordion value="details" class="" style="overflow:visible">
										<at-collapse-item name="details">
											<div slot="title">🔨 Initial Card Setup</div>
											<div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
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
											<div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1 tw-mt-3">
												<p class="tw-font-bold">Filtering</p>
											</div>
											<div class="tw-p-2">
												<p class="tw-font-semibold tw-mb-1">Search Tags</p>
												<at-select v-model="$parent.listing.tags" multiple>
													@foreach (trans('homepage.tag') as $key => $tag)
														<at-option key="{{ $key }}" value="{{ $key }}">{{ $tag['name'] }}</at-option>
													@endforeach
												</at-select>
											</div>
											<div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1 tw-mt-3">
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
											<div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1 tw-mt-3">
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
														<div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
															<p class="tw-font-bold">Player Configuration Setup</p>
														</div>
														@component('listing.partial.config', ['name' => __('profile.config.max_base_level.name')])
															<at-input v-model="$parent.listing.config.max_base_level" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('profile.config.max_job_level.name')])
															<at-input v-model="$parent.listing.config.max_job_level" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('profile.config.max_aspd.name')])
															<at-input v-model="$parent.listing.config.max_aspd" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('profile.config.max_stats.name')])
															<at-input v-model="$parent.listing.config.max_stats" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														<div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
															<p class="tw-font-bold">Experience Points Setup</p>
														</div>
														@component('listing.partial.config', ['name' => __('profile.config.base_exp_rate.name')])
															<at-input v-model="$parent.listing.config.base_exp_rate" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('profile.config.job_exp_rate.name')])
															<at-input v-model="$parent.listing.config.job_exp_rate" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('profile.config.quest_exp_rate.name')])
															<at-input v-model="$parent.listing.config.quest_exp_rate" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														<div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
															<p class="tw-font-bold">Drop Rate Setup</p>
														</div>
														@component('listing.partial.config', ['name' => __('profile.config.item_drop_common.name')])
															<at-input v-model="$parent.listing.config.item_drop_common" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('profile.config.item_drop_equip.name')])
															<at-input v-model="$parent.listing.config.item_drop_equip" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('profile.config.item_drop_card.name')])
															<at-input v-model="$parent.listing.config.item_drop_card" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('profile.config.item_drop_common_mvp.name')])
															<at-input v-model="$parent.listing.config.item_drop_common_mvp" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('profile.config.item_drop_equip_mvp.name')])
															<at-input v-model="$parent.listing.config.item_drop_equip_mvp" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('profile.config.item_drop_card_mvp.name')])
															<at-input v-model="$parent.listing.config.item_drop_card_mvp" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														<div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
															<p class="tw-font-bold">Battle Setup</p>
														</div>
														@component('listing.partial.config', ['name' => __('profile.config.instant_cast.name')])
															<div class="tw-flex">
																<at-radio v-model="$parent.listing.config.instant_cast_stat" label="No">No</at-radio>
																<at-radio v-model="$parent.listing.config.instant_cast_stat" label="Yes">Yes</at-radio>
															</div>
														@endcomponent
														@component('listing.partial.config', ['name' => __('profile.config.pk_mode.name')])
															<div class="tw-flex">
																<at-radio v-model="$parent.listing.config.pk_mode" label="No">No</at-radio>
																<at-radio v-model="$parent.listing.config.pk_mode" label="Yes">Yes</at-radio>
															</div>
														@endcomponent
														@component('listing.partial.config', ['name' => __('profile.config.arrow_decrement.name')])
															<div class="tw-flex">
																<at-radio v-model="$parent.listing.config.arrow_decrement" label="No">No</at-radio>
																<at-radio v-model="$parent.listing.config.arrow_decrement" label="Yes">Yes</at-radio>
															</div>
														@endcomponent
														@component('listing.partial.config', ['name' => __('profile.config.undead_detect_type.name')])
															<div class="tw-flex">
																<at-radio v-model="$parent.listing.config.undead_detect_type" label="No">No</at-radio>
																<at-radio v-model="$parent.listing.config.undead_detect_type" label="Yes">Yes</at-radio>
															</div>
														@endcomponent
														@component('listing.partial.config', ['name' => __('profile.config.attribute_recover.name')])
															<div class="tw-flex">
																<at-radio v-model="$parent.listing.config.attribute_recover" label="No">No</at-radio>
																<at-radio v-model="$parent.listing.config.attribute_recover" label="Yes">Yes</at-radio>
															</div>
														@endcomponent
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
									<div :class="'use-accent-'+$parent.accent" class="mb-3 server-card item flex-fill border rounded">

											<div id="profile-card" class="profile-block">
											<div class="server-card-head image rounded-top" style="height:350px;" v-bind:style="{ backgroundImage: 'url(' + $parent.background + ')' }"></div>
											<div class="server-card-head overlap d-flex" style="margin-top:-169px;">
												<i class="fas fa-arrow-left tw-text-white tw-text-2xl tw-absolute tw-align-top"></i>
												<div class="left-side d-flex w-75 flex-column align-items-start px-4 py-2 align-self-end">
													<h1 class="text-white font-weight-bold mb-0" style="font-size: 26px; color:rgb(243, 243, 243);">@{{ $parent.listing.name }}</h1>
													<ul class="tag-list list-unstyled d-flex tw-text-xs tw-text-green-light" style="font-size:13px;">
														<li class="mr-2" v-for="tag in $parent.listing.tags">#@{{ tag }}</li>
														<li class="mr-2" v-if="!$parent.listing.tags.length">#TagYourServerFunctionality</li>
													</ul>
												</div>
												<div class="right-side flex-fill d-flex justify-content-end pr-3" style="padding-bottom:12px;">
													<div class="d-flex flex-column justify-content-end mr-3" style="height:100%;">
														<h3 class="card-counter-title mb-0 font-weight-bold transparency">Votes</h3>
														<span class="card-counter font-weight-bold transparency">@{{ $parent.listing.ranking.votes }}</span>
													</div>
													<div class="d-flex flex-column justify-content-end mr-2" style="height:100%;">
														<h3 class="card-counter-title mb-0 font-weight-bold transparency">Clicks</h3>
														<span class="card-counter font-weight-bold transparency">@{{ $parent.listing.ranking.clicks }}</span>
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
															@component('listing.partial.config', ['name' => __('profile.config.max_base_level.name'), 'tooltip' => __('profile.config.max_base_level.describe')])
																@{{ $parent.listing.config.max_base_level }}
															@endcomponent
															@component('listing.partial.config', ['name' => __('profile.config.max_job_level.name'), 'tooltip' => __('profile.config.max_job_level.describe')])
																@{{ $parent.listing.config.max_job_level }}
															@endcomponent
															@component('listing.partial.config', ['name' => __('profile.config.base_exp_rate.name'), 'tooltip' => __('profile.config.base_exp_rate.describe')])
																@{{ $parent.listing.config.base_exp_rate }}x
															@endcomponent
															@component('listing.partial.config', ['name' => __('profile.config.job_exp_rate.name'), 'tooltip' => __('profile.config.job_exp_rate.describe')])
																@{{ $parent.listing.config.job_exp_rate }}x
															@endcomponent
															@component('listing.partial.config', ['name' => __('profile.config.quest_exp_rate.name'), 'tooltip' => __('profile.config.quest_exp_rate.describe')])
																@{{ $parent.listing.config.quest_exp_rate }}x
															@endcomponent
														</div>
														<div class="list tw-w-1/2 tw-flex tw-flex-col tw-mx-2 mb-3">
															<div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
																<p class="tw-font-bold">Battle</p>
															</div>
															@component('listing.partial.config', ['name' => __('profile.config.instant_cast.name'), 'tooltip' => __('profile.config.instant_cast.describe')])
																@{{ $parent.listing.config.instant_cast_stat === 'Yes' ? 'Yes' : 'No' }}
															@endcomponent
															@component('listing.partial.config', ['name' => __('profile.config.pk_mode.name'), 'tooltip' => __('profile.config.pk_mode.describe')])
																@{{ $parent.listing.config.pk_mode === 'Yes'? 'Yes' : 'No' }}
															@endcomponent
															@component('listing.partial.config', ['name' => __('profile.config.arrow_decrement.name'), 'tooltip' => __('profile.config.arrow_decrement.describe')])
																@{{ $parent.listing.config.arrow_decrement === 'Yes'? 'Yes' : 'No' }}
															@endcomponent
															@component('listing.partial.config', ['name' => __('profile.config.undead_detect_type.name'), 'tooltip' => __('profile.config.undead_detect_type.describe')])
																@{{ $parent.listing.config.undead_detect_type === 'Yes' ? 'Yes' : 'No' }}
															@endcomponent
															@component('listing.partial.config', ['name' => __('profile.config.attribute_recover.name'), 'tooltip' => __('profile.config.attribute_recover.describe')])
																@{{ $parent.listing.config.attribute_recover === 'Yes' ? 'Yes' : 'No'}}
															@endcomponent
														</div>
													</div>
													<div class="tw-flex tw-flex-col tw--mx-2">
														<div :class="'bg-'+$parent.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
															<p class="tw-font-bold tw-capitalize">Drop Rates</p>
														</div>
														<div class="tw-flex">
															<div class="list tw-w-1/2 tw-flex tw-flex-col tw-mx-2 mb-3">
																@component('listing.partial.config', ['name' => __('profile.config.item_drop_common.name'), 'tooltip' => __('profile.config.item_drop_common.describe')])
																	@{{ $parent.listing.config.item_drop_common }}x
																@endcomponent
																@component('listing.partial.config', ['name' => __('profile.config.item_drop_equip.name'), 'tooltip' => __('profile.config.item_drop_equip.describe')])
																	@{{ $parent.listing.config.item_drop_equip }}x
																@endcomponent
																@component('listing.partial.config', ['name' => __('profile.config.item_drop_card.name'), 'tooltip' => __('profile.config.item_drop_card.describe')])
																	@{{ $parent.listing.config.item_drop_card }}x
																@endcomponent
															</div>
															<div class="list tw-w-1/2 tw-flex tw-flex-col tw-mx-2 mb-3">
																@component('listing.partial.config', ['name' => __('profile.config.item_drop_common_mvp.name'), 'tooltip' => __('profile.config.item_drop_common_mvp.describe')])
																	@{{ $parent.listing.config.item_drop_common_mvp }}x
																@endcomponent
																@component('listing.partial.config', ['name' => __('profile.config.item_drop_equip_mvp.name'), 'tooltip' => __('profile.config.item_drop_equip_mvp.describe')])
																	@{{ $parent.listing.config.item_drop_equip_mvp }}x
																@endcomponent
																@component('listing.partial.config', ['name' => __('profile.config.item_drop_card_mvp.name'), 'tooltip' => __('profile.config.item_drop_card_mvp.describe')])
																	@{{ $parent.listing.config.item_drop_card_mvp }}x
																@endcomponent
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
						</profile>
					</div>
				</div>
			</profile-page>
		</div>
	</div>
@endsection
