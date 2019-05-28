@extends('layouts.frame')

@section('content')
	<div class="shadow-inner">
		<div class="container pt-4">
			<div class="row pb-5 pt-2">
				<div id="sidebar" class="col-4">
					<div sticky-container class="tw-h-full">
						<div v-sticky sticky-offset="offset" sticky-side="top">
							<listing-configurator inline-template :tags="{{ $tags }}" default-description="{{ __('profile.creator.default_description') }}">
								<at-collapse accordion value="graphics" style="overflow:visible">
									<at-collapse-item name="details">
										<div slot="title">Detailing</div>
										<div class="">
											<p class="tw-font-semibold tw-mb-1">Server Name</p>
											<at-input @change="updateListing" v-model="listing.name" placeholder="Please input"></at-input>
										</div>
										<div class="tw-mt-3">
											<p class="tw-font-semibold tw-mb-1">Language</p>
											<at-select @on-change="updateListing" v-model="listing.language">
												<at-option value="english" label="English Server"><img src="/img/flags/english.png" alt=""></i> English Server</at-option>
											</at-select>
										</div>
										<div class="tw-mt-3">
											<p class="tw-font-semibold tw-mb-1">Server Tags</p>
											<at-select @on-change="updateListing" v-model="listing.tags" multiple>
												<at-option v-for="tag in tags" v-bind:key="tag['id']" :value="tag">@{{ tag['name'] }}</at-option>
											</at-select>
										</div>
										<div class="tw-mt-3">
											<p class="tw-font-semibold tw-mb-1">Description</p>
											<p>Markdown Supported (<a href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet">Guide Here</a>)</p>
											<at-textarea @change="updateListing" v-model="listing.description" min-rows="5" max-rows="15" placeholder="Write something catchy">@{{ compiledMarkdown }}</at-textarea>
										</div>
									</at-collapse-item>
									<at-collapse-item name="graphics">
										<div slot="title">Graphics</div>
										<div class="">
											<p class="tw-font-semibold tw-mb-1">Card Background <small>(Optimal size 608x350px)</small></p>
											<at-input @change="updateListing" v-model="listing.background" placeholder="Enter an Image URL"></at-input>
										</div>
										<div class="tw-mt-3">
											<p class="tw-font-semibold tw-mb-1">Accent Colors</p>
											<at-select v-model="listing.accent" class="tw-capitalize">
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
												<at-input @keyup.enter.native="addScreenshot" :status="validation.hasError('screenshot') ? 'error' : ''" @change="updateListing" icon="link" type="url" v-model="screenshot" class="tw-flex-1 tw-mr-2" placeholder="Enter an Image URL"></at-input>
												<at-button :disabled="validation.hasError('screenshot')" @click="addScreenshot" type="primary" icon="icon-plus"></at-button>
											</div>
											<span v-for="(screenshot, i) in listing.screenshots">
											<span class="tw-flex tw-flex-row tw-mb-2">
												<at-button @click="removeScreenshot(i)" size="small" icon="icon-trash-2 tw-text-red" class="tw-mr-2" circle></at-button>
												<at-input size="small" :placeholder="screenshot" class="tw-flex-1" disabled></at-input>
											</span>
										</span>
										</div>
									</at-collapse-item>
									<at-collapse-item name="uploader">
										<div slot="title">Config Uploader</div>
										<div class="">
											<div class="mb-3">
												<p class="tw-font-semibold tw-mb-1">Config Uploader</p>
												<p class="tw-mb-2">This handy uploader will parse multiple server configuration files and automatically generate your listing to save you time and to provide better accuracy.</p>
											</div>
											<div class="mb-3">
												<p class="tw-font-semibold tw-mb-1">Available File Types</p>
												<div class="tw-mb-3">
													<at-button>drops.conf</at-button>
												</div>
											</div>
											<vue-dropzone id="configUploader" @vdropzone-success="handleParsedConfig" :options="dropzoneOptions" :use-custom-slot="true">
												<div class="dropzone-custom-content">
													<h3 class="dropzone-custom-title">Drag and drop your rAthena or Herc config files here and we will take care, the rest of the work 😇!</h3>
												</div>
											</vue-dropzone>
										</div>
									</at-collapse-item>
								</at-collapse>
							</listing-configurator>
						</div>
					</div>
				</div>
				<div class="col-8">

					<listing-profile :listing="{{ new \App\Listings\Listing() }}" inline-template>
						<div class="">
							@include('listing.profile')
						</div>
					</listing-profile>
				</div>

			</div>

		</div>
	</div>
@endsection
