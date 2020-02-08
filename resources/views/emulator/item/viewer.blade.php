@extends('layouts.master')

@section('meta_tags')
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
@endsection

@section('wrapper')
    <div class="shadow-inner">
        <div class="tw-container tw-pt-5" id="browser">
                <div class="tw-pb-5 tw-pt-2 tw-flex">
                    <div class="tw-hidden lg:tw-block tw-px-3 lg:tw-w-1/3" id="sidebar">
                        @include('sidebar.message')
                    </div>
                    <div class="tw-px-4 lg:tw-w-2/3 tw-flex tw-flex-wrap">

                        {{ $item_slug }}

                    </div>
                </div>
        </div>
    </div>
@endsection
