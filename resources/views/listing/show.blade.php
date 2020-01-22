@extends('layouts.master')

@section('js')
    <div id="fb-root"></div>
    <script async>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
            fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
@endsection

@section('meta_tags')
    @if ($listing->exists)
        <!-- Primary Meta Tags -->
        <title>{{ $listing->name }} Server Information</title>
        <meta name="title" content="{{ $listing->name }} Server Information">
        <meta name="description" content="The best place to view reviews and analytics on {{ $listing->name }}">
        <meta name="keywords" content="{{ $listing->tags->implode('name', ', ') }}">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url($listing->route()) }}">
        <meta property="og:title" content="{{ $listing->name }} Server Information">
        <meta property="og:description" content="The best place to view reviews and analytics on {{ $listing->name }}">
        <meta property="og:image" content="{{  \Illuminate\Support\Facades\Storage::url($listing->background) }}">
    @else
        <!-- Primary Meta Tags -->
        <title>Create New Private Server Listing | Ragnaranks</title>
        <meta name="title" content="Create New Private Server Listing | Ragnaranks">
        <meta name="description" content="Design and upload your server listing on the best ragnarok server finder">
        <meta name="keywords" content="create,new,setup,v4p">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url('listing/create') }}">
        <meta property="og:title" content="Create New Private Server Listing | Ragnaranks">
        <meta property="og:description" content="Design and upload your server listing on the best ragnarok server finder">
        <meta property="og:image" content="{{  url('img/meta/og_image.png') }}">
    @endif
@endsection


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
