@extends('layouts.frame')

@section('content')
	<div class="shadow-inner">
		<div class="container pt-4">
			<div class="row pb-5 pt-2">
				<div id="sidebar" class="col-4">
					<listing-configurator inline-template :tags="{{ $tags }}">
						<at-collapse accordion value="graphics">
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
									<p class="tw-font-semibold tw-mb-1">Card Background</p>
									<at-input @change="updateListing" v-model="listing.background" placeholder="Enter an Image URL"></at-input>
								</div>
								<div class="tw-mt-3">
									<p class="tw-font-semibold tw-mb-1">Accent Colors</p>
									<at-select v-model="listing.accent" filterable>
										<at-option value="silver" class="important:tw-flex tw-items-center">Silver
											<div class="tw-flex-1 tw-flex tw-flex-row">
												<div class="tw-h-2 tw-w-2 tw-flex-1" style="background-color:#C9C9C9"></div>
												<div class="tw-h-2 tw-w-2 tw-flex-1" style="background-color:#B9B9B9"></div>
												<div class="tw-h-2 tw-w-2 tw-flex-1" style="background-color:#9B9B9B"></div>
											</div>
										</at-option>
									</at-select>
								</div>
								<div class="tw-mt-3">
									<p class="tw-font-semibold tw-mb-1">Screenshots</p>
									<div class="tw-flex tw-flex-row">
										<at-input @change="updateListing" v-model="screenshot" class="tw-flex-1 tw-mr-2" placeholder="Enter an Image URL"></at-input>
										<at-button @click="addScreenshot" class="tw-h-1 tw-w-1 tw-mt-2 tw-mr-2" type="primary" icon="icon-plus" circle></at-button>
									</div>
									<span v-for="screenshot in listing.screenshots">
										<p>@{{ screenshot }}</p>
									</span>
								</div>
							</at-collapse-item>
							<at-collapse-item name="configs">
								<div slot="title">Configuration</div>
								<div class="tw-flex tw-justify-between">
									//
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
											<h3 class="dropzone-custom-title">Drag and drop to upload content!</h3>
											<div class="subtitle">...or click to select a file from your computer</div>
										</div>
									</vue-dropzone>
								</div>
							</at-collapse-item>
						</at-collapse>
					</listing-configurator>
				</div>
				<div class="col-8">

					<listing-profile :listing="{{ new \App\Listings\Listing() }}" default-description="{{ __('profile.creator.default_description') }}" inline-template>
						<div class="">
							@include('listing.profile')
						</div>
					</listing-profile>
				</div>

			</div>

		</div>
	</div>
@endsection