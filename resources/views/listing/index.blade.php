@extends('layouts.master')

@section('meta_tags')
    <!-- Primary Meta Tags -->
    <title>Top 100 Ragnarok Private Servers | Ragnaranks</title>
    <meta name="title" content="Top 100 Ragnarok Private Servers | Ragnaranks">
    <meta name="description" content="The worlds best website for finding ragnarok private servers in 2020">
    <meta name="keywords" content="reviews,search,vote,population,status,screenshots,analytics,v4p">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Top 100 Ragnarok Private Server Listings 2020">
    <meta property="og:description" content="The worlds best website for finding ragnarok private servers in 2020">
    <meta property="og:image" content="{{ url('img/meta/og_image.png') }}">
@endsection

@section('wrapper')
    <homepage inline-template>
        <div class="shadow-inner">
            <div class="tw-container tw-pt-5" id="listingView">
{{--                @if (auth()->check())--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-12 pb-3">--}}
{{--                            <at-alert show-icon message="We are currently investigating issues with some images failing to upload and hope to have this fixed shortly." type="error"></at-alert>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @if (!auth()->user()->hasVerifiedEmail())--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-12 pb-3">--}}
{{--                                <at-alert message="Verification Required" description="A verification email has been sent and awaiting response, account functionality is limited until completed, email may be found in spam or inbox folder!" type="error" show-icon></at-alert>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                @endif--}}
                <div class="tw-flex pb-2 pt-2 tw-flex-wrap">
                    <div id="sidebar" class="lg:tw-w-1/3 tw-px-3 tw-flex-1">
                        @include('sidebar.message')
                        @auth
                        <div class="content tw-shadow tw-hidden lg:tw-block p-2 mt-2">
                            <div class="d-flex align-items-center">
                                <img class="mr-1" src="/img/icons/coin.png" alt="" height="20" width="20">
                                <p>Welcome <span class="font-weight-bold">{{ user()->username  }}</span></p>
                            </div>
                        </div>
                        @endauth
                        <a href="{{ route('database') }}">
                            <div class="tw-px-6 tw-py-6 tw-mt-4 tw-bg-white tw-shadow tw-rounded">
                                <h2 class="tw-font-semibold tw-mb-0">Database Item/Mob Search</h2>
                            </div>
                        </a>
                        @include('sidebar.filter')
                        @include('sidebar.recent')
                        @include('sidebar.reviews')
                        @include('sidebar.trending.popular-items')
                        @include('sidebar.social')
                    </div>
                    <div class="lg:tw-w-2/3 tw-px-4 tw-w-full" id="listingsContainer" ref="listingsContainer">
                        <filtered-listings :data="listings.data" space="{{ config('filesystems.disks.spaces.domain') }}"></filtered-listings>
                        <div v-if="listings.meta.total > 0" class="tw-flex tw-flex-row tw-bg-transparent tw-rounded tw-border tw-border-gray-300 tw-mb-6 lg:tw-mb-2 tw-shadow tw-items-center tw-py-2 tw-px-4 tw-justify-between tw-bg-white">
                            <at-button :disabled="listings.meta.current_page <= 1" @click="changePage(listings.meta.current_page - 1)" size="normal" type="primary">« Prev</at-button>
                            <at-pagination @page-change="changePage" :show-quickjump="true" :show-total="true" class="tw-pl-0 tw-mb-0" :current="listings.meta.current_page" :page-size="listings.meta.per_page" :total="listings.meta.total"></at-pagination>
                            <at-button :disabled="listings.meta.current_page >= listings.meta.last_page" @click="changePage(listings.meta.current_page + 1)" size="normal" type="primary">Next »</at-button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </homepage>

@endsection
