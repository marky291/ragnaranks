@extends('layouts.frame')

@section('content')
	<div class="shadow-inner">
		<div class="container pt-4">
			<div class="row pb-5 pt-2">
				<div id="sidebar" class="col-4">
					<listing-configurator inline-template :tags="{{ $tags }}">
						<at-collapse accordion :value="value">
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
									<at-textarea @change="updateListing" v-model="listing.description" min-rows="5" max-rows="15" placeholder="Write something catchy"></at-textarea>
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
									<at-select v-model="model8" filterable>
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
									<at-input @change="updateListing" v-model="listing.background" class="tw-flex-1 tw-mr-2 tw-mt-2" placeholder="Enter an Image URL"></at-input>
									<div class="tw-flex tw-flex-row">
										<at-button class="tw-h-1 tw-w-1 tw-mt-2 tw-mr-2" type="primary" icon="icon-plus" circle></at-button>
									</div>
								</div>
							</at-collapse-item>
						</at-collapse>
					</listing-configurator>
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