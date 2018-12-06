@extends('layouts.frame')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-8 py-5">

                @foreach($servers as $server)

                    @include('partials.cards.normal', ['server' => $server])

                @endforeach

            </div>

            <div id="sidebar" class="col-4 py-5">

                <div class="content">
                    <h3 class=" text-orange">Site Messages</h3>
                    <p class="subheading">We are always interested in listening to feedback and improving our
                        service, let your voice be heard at our subrredit <a href="https://www.reddit.com/r/RagnaRanks">r/Ragnaranks</a>
                    </p>
                </div>

                <div class="heading">
                    <h3>Weekly Mentions</h3>
                </div>
                <?php /** @var \App\Server $server */ ?>

                <div id="awards" class="content py-0">
                    @include('partials.sidebar.statistic', [
                        'server' => \App\Server\CardinalServerRepository::HighestVoteTrend(),
                        'message' => "Top Trending Votes",
                        'column' => 'votes_trend',
                    ])
                    @include('partials.sidebar.statistic', [
                        'server' => \App\Server\CardinalServerRepository::HighestClicksTrend(),
                        'message' => "Top Trending Visits",
                        'column' => 'clicks_trend',
                    ])
                </div>

                <div class="heading">
                    <h3>Latest Reviews</h3>
                </div>

                <div id="reviews" class="content py-0">
                    @foreach (\App\Server\CardinalServerRepository::LatestServerReviews(5) as $server)
                        <div class="card card-basic listing d-flex flex-row">
                            <div class="detail flex-fill">
                                <div class="top">
                                    <a href="">No Review System</a>
                                </div>
                                <div class="bottom">
                                    <i class="fas fa-server"></i> {{ $server->getExpGroupAttribute() }}
                                    <i class="ml-2 fas fa-clock"></i> {{ $server->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <div class="show-counter bg-light text-info d-flex align-items-center justify-content-center rounded">
                                {{ rand(15, 100) }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

@endsection