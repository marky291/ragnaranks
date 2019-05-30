@extends('layouts.frame')

@section('content')
	<div class="shadow-inner">
		<div class="container pt-4">
			<listing-profile :listing="{{ new \App\Listings\Listing() }}" inline-template>
				<div class="row pb-5 pt-2">
					<div id="sidebar" class="col-4">
						<div sticky-container class="tw-h-full">
							<div v-sticky sticky-offset="offset" sticky-side="top">
								<listing-configurator inline-template :tags="{{ $tags }}">
									<at-collapse accordion value="config" style="overflow:visible">
										<at-collapse-item name="details">
											<div slot="title">Detailing</div>
											<div class="">
												<p class="tw-font-semibold tw-mb-1">Server Name</p>
												<at-input v-model="$parent.listing.name" placeholder="Please input"></at-input>
											</div>
											<div class="tw-mt-3">
												<p class="tw-font-semibold tw-mb-1">Language</p>
												<at-select v-model="$parent.listing.language">
													<at-option value="english" label="English Server"><img src="/img/flags/english.png" alt=""></i> English Server</at-option>
												</at-select>
											</div>
											<div class="tw-mt-3">
												<p class="tw-font-semibold tw-mb-1">Server Tags</p>
												<at-select v-model="$parent.listing.tags" multiple>
													<at-option v-for="tag in tags" v-bind:key="tag['id']" :value="tag['name']">@{{ tag['name'] }}</at-option>
												</at-select>
											</div>
											<div class="tw-mt-3">
												<p class="tw-font-semibold tw-mb-1">Description</p>
												<p>Markdown Supported (<a href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet">Guide Here</a>)</p>
												<at-textarea v-model="$parent.listing.description" min-rows="5" max-rows="15" placeholder="Write something catchy"></at-textarea>
											</div>
										</at-collapse-item>
										<at-collapse-item name="graphics">
											<div slot="title">Graphics</div>
											<div class="">
												<p class="tw-font-semibold tw-mb-1">Card Background <small class="tw-text-blue">(Optimal size 728x350px)</small></p>
												<at-input v-model="$parent.listing.background" placeholder="Enter an Image URL"></at-input>
											</div>
											<div class="tw-mt-3">
												<p class="tw-font-semibold tw-mb-1">Accent Colors</p>
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
											<div class="tw-mt-3">
												<div class="tw-flex tw-flex-row tw-justify-around">
													<p class="tw-flex-1 tw-font-semibold tw-mb-1">Screenshots</p>
													<div class="tw-flex-1 tw-text-right help-block invalid-feedback">@{{ validation.firstError('screenshot') }}</div>
												</div>
												<div class="tw-flex tw-flex-row tw-mb-3">
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
										</at-collapse-item>
										<at-collapse-item name="config">
											<div slot="title">Configuration</div>
											<div class="">
												<vue-dropzone id="configUploader" @vdropzone-success="handleParsedConfig" :options="dropzoneOptions" :use-custom-slot="true" class="tw-mb-3">
													<div class="dropzone-custom-content tw-text-left">
														<p class="tw-text-xl tw-text-grey-darkest tw-mb-3"><i class="icon icon-file-text tw-mr-2"></i>UPLOAD!</p>
														<p class="dropzone-custom-title">This handy uploader will parse multiple server configuration files and automatically generate your listing to save you time and to provide better accuracy.</p>
														<p class="tw-font-bold tw-mt-3">Just Drag and Drop the suitable config files.</p>
													</div>
												</vue-dropzone>
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
														<div :class="'bg-'+$parent.listing.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
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
														<div :class="'bg-'+$parent.listing.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
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
														@component('listing.partial.config', ['name' => __('configs.item_drop_treasure.name')])
															<at-input v-model="$parent.listing.configs.item_drop_treasure" size="small" type="number" placeholder="Please input"></at-input>
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
														@component('listing.partial.config', ['name' => __('configs.drops_by_luk.name')])
															<at-switch>
																<span slot="checkedText">Yes</span>
																<span slot="unCheckedText">No</span>
															</at-switch>
														@endcomponent
														<div :class="'bg-'+$parent.listing.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
															<p class="tw-font-bold">Skill Casting Setup</p>
														</div>
														@component('listing.partial.config', ['name' => __('configs.cast_rate.name')])
															<at-input v-model="$parent.listing.configs.cast_rate" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.delay_rate.name')])
															<at-input v-model="$parent.listing.configs.delay_rate" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.castrate_dex_scale.name')])
															<at-input v-model="$parent.listing.configs.castrate_dex_scale" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.vcast_stat_scale.name')])
															<at-input v-model="$parent.listing.configs.vcast_stat_scale" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														<div :class="'bg-'+$parent.listing.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
															<p class="tw-font-bold">Battle Setup</p>
														</div>
														@component('listing.partial.config', ['name' => __('configs.arrow_decrement.name')])
															<at-switch>
																<span slot="checkedText">Yes</span>
																<span slot="unCheckedText">No</span>
															</at-switch>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.undead_detect_type.name')])
															<at-switch>
																<span slot="checkedText">Yes</span>
																<span slot="unCheckedText">No</span>
															</at-switch>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.attribute_recover.name')])
															<at-switch>
																<span slot="checkedText">Yes</span>
																<span slot="unCheckedText">No</span>
															</at-switch>
														@endcomponent
													</div>
												</div>
											</div>
										</at-collapse-item>
									</at-collapse>
								</listing-configurator>
							</div>
						</div>
					</div>
					<div class="col-8">
						<div class="">
							@include('listing.profile')
						</div>
					</div>
				</div>
			</listing-profile>
		</div>
	</div>
@endsection
