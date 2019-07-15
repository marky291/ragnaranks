@extends('layouts.frame')

@section('content')
    <div class="">
        <div class="tw-container pt-4">
            <div class="row">
                @if (auth()->check() && !auth()->user()->hasVerifiedEmail())
                    <div class="col-12 pb-3">
                        <at-alert message="Verification Required" description="Your account has limited functionality until you verify the email address!" type="error" show-icon></at-alert>
                    </div>
                @endif
            </div>
            <div class="tw-flex pb-5 pt-2 tw--mx-4 tw-flex-wrap">
                <div id="sidebar" class="lg:tw-w-1/3 tw-px-4">
                        @include('sidebar.message')
                        @include('sidebar.filter')
                        @include('sidebar.recent')
                        @include('sidebar.social')
                </div>
                <div class="lg:tw-w-2/3 tw-px-4">
                    <filtered-listings></filtered-listings>
                </div>

            </div>

        </div>
    </div>

@endsection