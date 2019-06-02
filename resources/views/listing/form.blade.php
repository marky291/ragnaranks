@extends('layouts.frame')

@section('content')
	<div class="shadow-inner">
		<div class="container pt-4">
			<listing-profile :listing="{{ new \App\Listings\Listing() }}" inline-template>
				<div class="row pb-5 pt-2">
					<div id="sidebar" class="col-4">
						<div class="tw-h-full">
							<listing-configurator inline-template :tags="{{ $tags }}" :languages="{{ $languages }}">
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
												<p class="tw-font-semibold tw-mb-1">Language</p>
												<div class="tw-flex">
													<at-select v-model="$parent.listing.language" class="tw-capitalize">
														<at-option v-for="(language, i) in languages" :key="i" :value="language.name" :label="language.name + ' speaking'"><img :src="'/img/flags/'+language.name+'.png'" alt=""></i> @{{ language.name }}</at-option>
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
{{--												<vue-dropzone id="configUploader" @vdropzone-success="handleParsedConfig" :options="dropzoneOptions" :use-custom-slot="true" class="tw-mb-3">--}}
{{--													<div class="dropzone-custom-content tw-text-left">--}}
{{--														<p class="tw-text-xl tw-text-grey-darkest tw-mb-3"><i class="icon icon-file-text tw-mr-2"></i>UPLOAD!</p>--}}
{{--														<p class="dropzone-custom-title">This handy uploader will parse multiple server configuration files and automatically generate your listing to save you time and to provide better accuracy.</p>--}}
{{--														<p class="tw-font-bold tw-mt-3">Just Drag and Drop the suitable config files.</p>--}}
{{--													</div>--}}
{{--												</vue-dropzone>--}}
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
														@component('listing.partial.config', ['name' => __('configs.item_drop_common_mvp.name')])
															<at-input v-model="$parent.listing.configs.item_drop_common_mvp" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.item_drop_equip_mvp.name')])
															<at-input v-model="$parent.listing.configs.item_drop_equip_mvp" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.item_drop_card_mvp.name')])
															<at-input v-model="$parent.listing.configs.item_drop_card_mvp" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														<div :class="'bg-'+$parent.listing.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
															<p class="tw-font-bold">Skill Casting Setup</p>
														</div>
														@component('listing.partial.config', ['name' => __('configs.instant_case.name')])
															<at-input v-model="$parent.listing.configs.instant_case" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														@component('listing.partial.config', ['name' => __('configs.castrate_dex_scale.name')])
															<at-input v-model="$parent.listing.configs.castrate_dex_scale" size="small" type="number" placeholder="Please input"></at-input>
														@endcomponent
														<div :class="'bg-'+$parent.listing.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
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
															<div :class="'bg-'+$parent.listing.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1 tw-mb-2">
																<p class="tw-font-bold">List Player Commands</p>
															</div>
															<multiselect v-model="$parent.listing.commands" :hide-selected="true" :close-on-select="false" :show-labels="false" open-direction="bottom" tag-placeholder="Add this Command" placeholder="Type an @Command" label="name" track-by="name" :options="commandChoices" :multiple="true" :taggable="true" @tag="addTag">
																{{--														<template slot="tag" slot-scope="option"><span class="option__desc"><span class="option__title">@{{ option.title }}</span></span></template>--}}
															</multiselect>
														</div>
													</div>
												</div>
											</div>
										</at-collapse-item>
									</at-collapse>
								</listing-configurator>
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
