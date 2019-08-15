@extends('layouts.frame')

@if (isset($name))
    @section('title', "Ragnaranks - {$name} Server Overview")
    @section('description', "View detailed statistics, reviews and screenshots about {$name} private ragnarok server.")
    @section('canonical', "{$route}")
@else
    @section('title', 'Ragnaranks - Create a new private server listing')
    @section('description', 'Design and create a profile listing that suits your style and configuration')
    @section('canonical', route('listing.create'))
@endif

@section('content')
	<div class="shadow-inner">
		<div class="container pt-4">
			<profile-page slug="{{ $slug }}" action="{{ request()->get('action') }}" auth="{{ auth()->id() }}" inline-template>
				<div class="row pb-5 pt-2">
					<div class="col-4 tw-hidden lg:tw-block" id="sidebar">
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
