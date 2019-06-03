
    <div>
        <div class="content">
            <h3 class="text-orange font-weight-bold">Site Messages</h3>
            <p class="subheading">We are always interested in listening to feedback and improving our
                service, let your voice be heard in our subreddit <a href="https://www.reddit.com/r/RagnaRanks">r/Ragnaranks</a> or <a href="http://discord.gg/WGSAce2">Discord</a>!
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

        {{ $slot }}

        <div class="tw-hidden lg:tw-block">
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
                                <at-button @click="redirect('{{ route('listing.show', $listing) }}')" type="info">Visit <i class="icon icon-arrow-right"></i></at-button>
                                {{--                                            <a href="{{ route('listing.show', $listing) }}" tabindex="0" class="btn btn-blue btn-sm">Visit <i class="icon icon-arrow-right"></i></a>--}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="social content shadow-inner bg-transparent p-3 tw-text-grey tw-text-4xl tw-text-center tw-hidden lg:tw-flex">
            <div class="tw-flex-1">
                <a href="https://www.facebook.com/ragnaranks/"><i class="tw-text-grey hover:tw-text-blue fab fa-facebook"></i></a>
            </div>
            <div class="tw-flex-1">
                <a href="http://discord.gg/WGSAce2"><i class="tw-text-grey hover:tw-text-blue fab fa-discord"></i></a>
            </div>
            <div class="tw-flex-1">
                <a href="https://www.reddit.com/r/RagnaRanks/"><i class="tw-text-grey hover:tw-text-blue fab fa-reddit"></i></a>
            </div>
        </div>

    </div>
