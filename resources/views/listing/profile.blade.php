@extends('layouts.frame')

@section('content')
	<div class="shadow-inner">
		<div class="container pt-4">
			<profile-page slug="{{ $slug ?? 'defaults' }}" inline-template>
				<div class="row pb-5 pt-2">
					<div class="col-4" id="sidebar">
						@component('layouts.sidebar')
{{--							<div class="tw-h-full tw-mt-4">--}}
{{--								<div class="heading">--}}
{{--									<h3>User Actions</h3>--}}
{{--								</div>--}}
{{--								<div class="content py-0 rounded py-3 d-flex flex-column" id="user-actions">--}}
{{--									<at-button class="mb-2" hollow type="primary">Back to Searching</at-button>--}}
{{--									<at-button class="mb-2" hollow>Visit Website</at-button>--}}
{{--									<span v-if="!isCurrentPage('voting')">--}}
{{--                      <at-button @click="setCurrentPage('voting')" class="w-100 mb-2" hollow>Vote for server</at-button>--}}
{{--                    </span>--}}
{{--									<span v-else>--}}
{{--                      <at-button @click="setCurrentPage('profile')" class="w-100 mb-2" hollow type="error">Back to Listing</at-button>--}}
{{--                    </span>--}}
{{--									<span v-if="!isCurrentPage('reviewing')">--}}
{{--                        <at-button @click="setCurrentPage('reviewing')" class="w-100" hollow type="success">Create a review</at-button>--}}
{{--                    </span>--}}
{{--									<span v-else>--}}
{{--                        <at-button @click="setCurrentPage('profile')" class="w-100" hollow type="error">Back to Listing</at-button>--}}
{{--                    </span>--}}
{{--								</div>--}}
{{--							</div>--}}
							<div class="tw-h-full mt-4">
								<configs :current="listing"
										 :configurations="configurations"
										 v-if="listing.isEditor">
								</configs>
							</div>
						@endcomponent
					</div>
					<div class="col-8">
						<profile :reviews="listing.reviews" :slug="slug"></profile>
					</div>
				</div>
			</profile-page>
		</div>
	</div>
@endsection
