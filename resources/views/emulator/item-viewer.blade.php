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
        <div class="tw-container browsing-container" id="browser">
            <div class="browsing-sidebar" id="sidebar">
                @include('sidebar.message')
            </div>
            <div class="browsing-content">
                @if ($cachedItemPartial = \Illuminate\Support\Facades\Cache::get("partials.item.{$item_slug}"))
                    {!! $cachedItemPartial !!}
                @else
                    <include-fragment src="/api/database/item/{{$item_slug}}">
                        @include('sidebar._listing-placeholder')
                    </include-fragment>
                @endif

                @if ($cachedFarmingPartial = \Illuminate\Support\Facades\Cache::get("partials.item.{$item_slug}.farming"))
                    {!! $cachedFarmingPartial !!}
                @else
                    <include-fragment src="/api/database/item/{{$item_slug}}/farming">
                        @include('sidebar._listing-placeholder')
                    </include-fragment>
                @endif

                @if ($cachedSellerPartial = \Illuminate\Support\Facades\Cache::get("partials.item.{$item_slug}.sellers"))
                    {!! $cachedSellerPartial !!}
                @else
                    <include-fragment src="/api/database/item/{{$item_slug}}/sellers">
                        @include('sidebar._listing-placeholder')
                    </include-fragment>
                @endif

                @if ($cachedMonstersPartial = \Illuminate\Support\Facades\Cache::get("partials.item.{$item_slug}.monsters"))
                    {!! $cachedMonstersPartial !!}
                @else
                    <include-fragment src="/api/database/item/{{$item_slug}}/monsters">
                        @include('sidebar._listing-placeholder')
                    </include-fragment>
                @endif
                
                @if ($cachedContainersPartial = \Illuminate\Support\Facades\Cache::get("partials.item.{$item_slug}.containers"))
                    {!! $cachedContainersPartial !!}
                @else
                    <include-fragment src="/api/database/item/{{$item_slug}}/containers">
                        @include('sidebar._listing-placeholder')
                    </include-fragment>
                @endif

                @if ($cachedContentsPartial = \Illuminate\Support\Facades\Cache::get("partials.item.{$item_slug}.contents"))
                    {!! $cachedContentsPartial !!}
                @else
                    <include-fragment src="/api/database/item/{{$item_slug}}/contents">
                        @include('sidebar._listing-placeholder')
                    </include-fragment>
                @endif
            </div>
        </div>
    </div>
@endsection
