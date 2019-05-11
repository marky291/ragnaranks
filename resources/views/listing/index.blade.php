@extends('layouts.frame')

@section('content')

{{--    @component('slots.spotlight')--}}
{{--        @slot('content')--}}
{{--            <div class="row">--}}
{{--                <div class="col-10 server-rates">--}}
{{--                    <div id="filter" class="d-flex py-4">--}}
{{--                        <h3 class="d-flex align-items-center mb-0 mr-4">I'm Looking for:</h3>--}}

{{--                        <select class="form-control-sm mr-2">--}}
{{--                            <option value="all">Any Rates</option>--}}
{{--                            <option value="">Official Rates</option>--}}
{{--                            <option value="">Low Rates</option>--}}
{{--                            <option value="">Mid Rates</option>--}}
{{--                            <option value="">High Rates</option>--}}
{{--                            <option value="">Super Rates</option>--}}
{{--                            <option value="">Instant Rates</option>--}}
{{--                        </select>--}}

{{--                        <select class="form-control-sm mr-2">--}}
{{--                            <option value="all">Any Mode</option>--}}
{{--                            @foreach(\App\Mode::all() as $mode)--}}
{{--                                <option value="">{{ ucfirst($mode->name) }} Mode</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}

{{--                        <select class="form-control-sm mr-2">--}}
{{--                            <option value="all">With Any Tags</option>--}}
{{--                            @foreach(\App\Tag::all() as $tag)--}}
{{--                                <option>With {{ ucfirst($tag->name) }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}

{{--                        <select class="form-control-sm mr-2">--}}
{{--                            <option>Sorted by Score</option>--}}
{{--                            <option>Sorted by Rank Position</option>--}}
{{--                            <option>Sorted by Date added</option>--}}
{{--                            <option>Sorted by Online since</option>--}}
{{--                        </select>--}}

{{--                        <select class="form-control-sm">--}}
{{--                            <option>And show 50 servers</option>--}}
{{--                            <option>And show 100 servers</option>--}}
{{--                            <option>And show 250 servers</option>--}}
{{--                            <option>And show 500 servers</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-2 justify-content-end align-self-center text-right">--}}
{{--                    Search Servers--}}
{{--                    <a class="text-muted" href="#">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endslot--}}
{{--    @endcomponent--}}

{{--    @component('slots.stage')--}}
{{--        @slot('content')--}}
{{--            <h4 class="title text-muted mb-0">Sponsored <i class="fas fa-info-circle"></i></h4>--}}
{{--            <div class="listings-stage">--}}
{{--                @foreach(app('listings')->take(3) as $listing)--}}
{{--                    <div class="carousel-cell mr-3">@include('partials.cards.preview', ['listing' => $listing])</div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        @endslot--}}
{{--    @endcomponent--}}


    <div class="shadow-inner">
        <div class="container">

            <div class="row">

                <div id="sidebar" class="col-4 py-5">
                    <div>
                        <div class="content">
                            <h3 class="text-orange font-weight-bold">Site Messages</h3>
                            <p class="subheading">We are always interested in listening to feedback and improving our
                                service, let your voice be heard at our subredit <a href="https://www.reddit.com/r/RagnaRanks">r/Ragnaranks</a>
                            </p>
                        </div>

                        {{--<div class="heading">--}}
                        {{--<h3>Weekly Mentions</h3>--}}
                        {{--</div>--}}
                        {{--<div id="awards" class="content py-0">--}}
                        {{--@include('partials.sidebar.statistic', [--}}
                        {{--                            {{-listinger' => App\Listings::HighestVoteTrend()->first(),--}}{{----}}
                        {{--'message' => "Top Trending Votes",--}}
                        {{--'column' => 'votes_trend',--}}
                        {{--])--}}
                        {{--@include('partials.sidebar.statistic', [--}}
                        {{--                            {{-listinger' => App\Listings::HighestClickTrend()->first(),--}}{{----}}
                        {{--'message' => "Top Trending Visits",--}}
                        {{--'column' => 'clicks_trend',--}}
                        {{--])--}}
                        {{--</div>--}}

                        <div class="heading">
                            <h3>Filtered Search</h3>
                        </div>

                        <filtered-search></filtered-search>

                        <div class="heading">
                            <h3>Newest Additions</h3>
                        </div>

                        <div id="additions" class="content py-0 rounded">
                            @foreach (app('listings')->filterSort('created_at')->take(8) as $listing)
                                <div class="microcard" style="{{ $loop->last ? null : 'border-bottom: 1px dashed #e3e3e3;' }}">
                                    <div class="information d-flex flex-row py-3">
                                        <div class="icon text-green align-self-center mr-3">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                        <div class="details flex-grow-1">
                                            <h3 class="mb-0 tw-text-grey-darkest tw-text-xs">{{ $listing->name }}</h3>
                                            <p class="tw-text-grey-dark tw-text-xs">Created {{ $listing->created_at->format('dS F Y') }}</p>
                                        </div>
                                        <div class="buttons w-25 d-flex align-items-center justify-content-end">
                                            <a href="{{ route('listing.show', $listing) }}" tabindex="0" class="btn btn-blue btn-sm">Visit <i class="fas fa-long-arrow-alt-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-8 py-5">

                    <filtered-listings></filtered-listings>

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