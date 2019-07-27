@extends('layouts.frame')

@section('content')
    <homepage inline-template>
        <div class="">
            <div class="tw-container pt-4">
                <div class="row">
                    @if (auth()->check() && !auth()->user()->hasVerifiedEmail())
                        <div class="col-12 pb-3">
                            <at-alert message="Verification Required" description="A verification email has been sent and awaiting response, account functionality is limited until completed!" type="error" show-icon></at-alert>
                        </div>
                    @endif
                </div>
                <div class="tw-flex pb-5 pt-2 tw--mx-4 tw-flex-wrap">
                    <div id="sidebar" class="lg:tw-w-1/3 tw-px-4">
                        @include('sidebar.message')
{{--                        @include('sidebar.paginate')--}}
                        @include('sidebar.filter')
                        @include('sidebar.recent')
                        @include('sidebar.social')
                    </div>
                    <div class="lg:tw-w-2/3 tw-px-4" id="listingsContainer" ref="listingsContainer">
                        <filtered-listings :data="listings.data"></filtered-listings>
                        <div class="tw-flex tw-flex-row tw-bg-transparent tw-mb-6 lg:tw-mb-0 tw-items-center tw-py-2 tw-justify-around">
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