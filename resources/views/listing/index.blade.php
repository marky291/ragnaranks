@extends('layouts.frame')

@section('title', 'Ragnaranks - Ragnarok Private Server Listings')
@section('description', 'Browse hundreds of listings using our unique ranking algorithm, with advanced filtering, reviews & voting we will find your next perfect server.')
@section('canonical', route('index'))

@section('content')
    <homepage inline-template>
        <div class="shadow-inner">
            <div class="tw-container tw-pt-5" id="listingView">
                @if (auth()->check())
{{--                    <div class="row">--}}
{{--                        <div class="col-12 pb-3">--}}
{{--                            <at-alert show-icon message="We are currently investigating issues with some images failing to upload and hope to have this fixed shortly." type="error"></at-alert>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    @if (!auth()->user()->hasVerifiedEmail())
                        <div class="row">
                            <div class="col-12 pb-3">
                                <at-alert message="Verification Required" description="A verification email has been sent and awaiting response, account functionality is limited until completed, email may be found in spam or inbox folder!" type="error" show-icon></at-alert>
                            </div>
                        </div>
                    @endif
                @endif
                <div class="tw-flex pb-2 pt-2 tw-flex-wrap">
                    <div id="sidebar" class="lg:tw-w-1/3 tw-px-3 tw-flex-1">
                        @include('sidebar.message')
{{--                        @include('sidebar.paginate')--}}
                        @include('sidebar.filter')
                        @include('sidebar.recent')
                        @include('sidebar.social')
                    </div>
                    <div class="lg:tw-w-2/3 tw-px-4 tw-w-full" id="listingsContainer" ref="listingsContainer">
                        <filtered-listings :data="listings.data" space="{{ config('filesystems.disks.spaces.domain') }}"></filtered-listings>
                        <div v-if="listings.meta.total > listings.meta.per_page" class="tw-flex tw-flex-row tw-bg-transparent tw-mb-6 lg:tw-mb-0 tw-items-center tw-py-2 tw-justify-around">
                            <at-button @click="changePage(1)" size="normal">First</at-button>
                            <at-pagination @page-change="changePage" :show-quickjump="true" :show-total="true" class="tw-pl-0 tw-mb-0" :current="listings.meta.current_page" :page-size="listings.meta.per_page" :total="listings.meta.total"></at-pagination>
                            <at-button @click="changePage(listings.meta.last_page)" size="normal">Last</at-button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </homepage>

@endsection
