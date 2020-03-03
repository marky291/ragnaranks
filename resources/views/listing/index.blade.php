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
    <server-browser inline-template>
        <div class="shadow-inner">
            <div class="tw-container tw-pt-5" id="listingView">
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
                        <server-search></server-search>
                        @include('sidebar.recent')
                        @include('sidebar.reviews')
                        @include('sidebar.social')
                    </div>


                    <div class="lg:tw-w-2/3 tw-px-4 tw-w-full" id="listingsContainer" ref="listingsContainer">
                        <server-list :listings="post.data"></server-list>
                        <!-- <div v-if="!post.meta.total > 0" class="mb-4 load-animation">
                            <div class="d-flex flex-column text-center">
                                <div class="col d-flex justify-content-center">
                                    <img src="/img/icons/omg-sticker.png" alt="">
                                </div>
                                <div class="col">
                                    <h3><b>Whoops!</b> No listings found with your search parameters</h3>
                                    <p>It could just be that no such servers exist or they just have not found their home at Ragnaranks.com yet!</p>
                                </div>
                            </div>
                        </div>
                        <div v-if="post.meta.total > 0" class="tw-flex tw-flex-row tw-bg-transparent tw-rounded tw-border tw-border-gray-300 tw-mb-6 lg:tw-mb-2 tw-shadow tw-items-center tw-py-2 tw-px-4 tw-justify-between tw-bg-white">
                            <at-button :disabled="post.meta.current_page <= 1" @click="changePage(post.meta.current_page - 1)" size="normal" type="primary">« Prev</at-button>
                            <at-pagination @page-change="changePage" :show-quickjump="true" :show-total="true" class="tw-pl-0 tw-mb-0" :current="post.meta.current_page" :page-size="post.meta.per_page" :total="post.meta.total"></at-pagination>
                            <at-button :disabled="post.meta.current_page >= post.meta.last_page" @click="changePage(post.meta.current_page + 1)" size="normal" type="primary">Next »</at-button>
                        </div> -->
                    </div>

                </div>

            </div>
        </div>
    </server-browser>

@endsection
