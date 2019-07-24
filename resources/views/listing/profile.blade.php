@extends('layouts.frame')

@section('content')
	<div class="shadow-inner">
		<div class="container pt-4">
			<profile-page slug="{{ $slug }}" inline-template>
				<div class="row pb-5 pt-2">
					<div class="col-4" id="sidebar">
						@include('sidebar.message')
						<div v-if="!listing.isEditor">
							@include('sidebar.selector')
						</div>
						@include('sidebar.config')
						<div v-if="!listing.isEditor">
							@include('sidebar.recent')
							@include('sidebar.social')
						</div>
					</div>
					<div class="col-8">
						<profile :reviews="listing.reviews" :slug="slug"></profile>
					</div>
				</div>
			</profile-page>
		</div>
	</div>
@endsection
