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
						<profile :slug="slug" :reviews="listing.reviews"></profile>
					</div>
				</div>
			</profile-page>
		</div>
	</div>
@endsection
