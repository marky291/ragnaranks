@extends('layouts.master')

@section('title', 'Ragnaranks - Ragnarok Private Server Listings')
@section('description', 'Browse hundreds of listings using our unique ranking algorithm, with advanced filtering, reviews & voting we will find your next perfect server.')
@section('canonical', route('item_database'))

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
                        @include('sidebar.database')
                        {{--                        @include('sidebar.paginate')--}}
                        @include('sidebar.filter')
                        @include('sidebar.reviews')
                        @include('sidebar.recent')
                        @include('sidebar.social')
                    </div>
                    <div class="lg:tw-w-2/3 tw-px-4 tw-w-full" id="listingsContainer" ref="listingsContainer">
                        //
                    </div>

                </div>

            </div>
        </div>
    </homepage>

@endsection
