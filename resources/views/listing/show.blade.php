@extends('layouts.master')

@if ($listing->exists)
    @section('title', "{$listing->name} Private Server Information - Ragnaranks")
    @section('description', "Server information about {$listing->name} such as server description, reviews, ratings, ranks, votes and status reports.")
    @section('keywords', $listing->name . ', ' . $listing->tags->implode('name', ', ') . ', reviews, information, rating, website, ranking, configs')
    @section('canonical', route('listing.show', $listing))
@else
    @section('title', 'Create a new private server listing - Ragnaranks')
    @section('description', 'Design and create a profile listing that suits your server style and configuration')
    @section('canonical', route('listing.create'))
@endif

@section('wrapper')
	<div class="shadow-inner">
		<div class="tw-container tw-pt-5">
			<profile-page slug="{{ $listing->slug }}" action="{{ request()->get('action') }}" auth="{{ auth()->id() }}" inline-template>
				<div class="tw-pb-5 tw-pt-2 tw-flex">
					<div class="tw-hidden lg:tw-block tw-px-3 lg:tw-w-1/3" id="sidebar">
						@include('sidebar.message')
						<div v-if="!isCreating()">
							@include('sidebar.selector')
						</div>
						<div v-if="listing.isEditor">
                            @include('sidebar.config')
                        </div>
						<div v-else="!listing.isEditor">
							@include('sidebar.recent')
                            @include('sidebar.reviews')
							@include('sidebar.social')
						</div>
					</div>
					<div class="tw-px-4 lg:tw-w-2/3">
						<profile :reviews="listing.reviews" :breakdown="{{ $breakdown ?? 'null' }}" :slug="slug" space="{{ config('filesystems.disks.spaces.domain') }}/"></profile>
                        @if (isset($listing->user) && auth()->check() && user()->hasRole('admin'))
                            <div class="d-flex justify-content-around content tw-hidden lg:tw-block my-2">
                                <p><b>Owner username:</b><br> {{ $listing->user->username }}</p>
                                <p><b>Owner email:</b><br> {{ $listing->user->email }}</p>
                            </div>
                        @endif
					</div>
				</div>
			</profile-page>
		</div>
	</div>
@endsection
