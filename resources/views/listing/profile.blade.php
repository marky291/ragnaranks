@extends('layouts.frame')

@if (isset($name))
    @section('title', "{$name} Server Overview | Ragnaranks")
    @section('description', 'View detailed statistics, reviews and screenshots about this private ragnarok server.')
@else
    @section('title', 'Create a new private server listing')
    @section('description', 'Design and create a profile listing that suits your style and configuration')
@endif

@section('content')
	<div class="shadow-inner">
		<div class="container pt-4">
			<profile-page slug="{{ $slug }}" action="{{ request()->get('action') }}" auth="{{ auth()->id() }}" inline-template>
				<div class="row pb-5 pt-2">
					<div class="col-4" id="sidebar">
						@include('sidebar.message')
						<div v-if="!isCreating()">
							@include('sidebar.selector')
						</div>
						@include('sidebar.config')
						<div v-if="!listing.isEditor">
							@include('sidebar.recent')
							@include('sidebar.social')
						</div>
					</div>
					<div class="col-8">
						<profile :reviews="listing.reviews" :slug="slug" space="{{ config('filesystems.disks.spaces.domain') }}/"></profile>
					</div>
				</div>
			</profile-page>
		</div>
	</div>
@endsection
