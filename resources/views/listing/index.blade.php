@extends('layouts.frame')

@section('content')
    <div class="shadow-inner">
        <div class="container pt-4">
            <div class="row">
                @if (auth()->check() && !auth()->user()->hasVerifiedEmail())
                    <div class="col-12 pb-3">
                        <at-alert message="Verification Required" description="Your account has limited functionality until you verify the email address!" type="error" show-icon></at-alert>
                    </div>
                @endif
            </div>
            <div class="row pb-5 pt-2">
                <div id="sidebar" class="col-4">
                    @component('layouts.sidebar')
                        <div class="heading">
                            <h3>Filtered Search</h3>
                        </div>
                        <filtered-search :tags="{{ $tags }}"></filtered-search>
                    @endcomponent
                </div>
                <div class="col-8">
                    <filtered-listings :initial-listings="{{ $listings }}"></filtered-listings>

{{--                    @foreach($listings as $listing)--}}
{{--                        @if ($loop->first)--}}
{{--                            {{ $listing }}--}}
{{--                        @endif--}}
{{--                        <div class="mb-4">--}}
{{--                            @include('partials.cards.normal', ['listing' => $listing])--}}
{{--                        </div>--}}
{{--                    @endforeach--}}

                </div>

            </div>

        </div>
    </div>

@endsection