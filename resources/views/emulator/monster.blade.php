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
                
            <div class="load-animation">
                <h1>{{ $monster->name }}</h1>
                <div class="section tw-grid tw-grid-cols-3">
                    <div class="tw-col-span-2">
                        <div class="tw-grid tw-grid-cols-4 tw-grid-rows tw-capitalize">
                            <div class="tw-col-span-2"><p class="tw-font-semibold">HP</p></div>
                            <div class="tw-col-span-2"><p>{{ $monster->stats->health }}</p></div>
                            <div class="tw-col-span-2"><p class="tw-font-semibold">Level</p></div>
                            <div class="tw-col-span-2"><p>{{ $monster->stats->level }}</p></div>
                            <div class="tw-col-span-2"><p class="tw-font-semibold">Hit</p></div>
                            <div class="tw-col-span-2"><p>{{ $monster->stats->hit }}</p></div>
                            <div class="tw-col-span-2"><p class="tw-font-semibold">Flee</p></div>
                            <div class="tw-col-span-2"><p>{{ $monster->stats->flee }}</p></div>
                            <div class="tw-col-span-2"><p class="tw-font-semibold">Attack</p></div>
                            <div class="tw-col-span-2"><p>{{ $monster->stats->attack['minimum'] }} ~ {{ $monster->stats->attack['maximum'] }}</p></div>
                            <div class="tw-col-span-2"><p class="tw-font-semibold">Magic Attack</p></div>
                            <div class="tw-col-span-2"><p>{{ $monster->stats->magicAttack['minimum'] }} ~ {{ $monster->stats->magicAttack['maximum'] }}</p></div>
                            <div class="tw-col-span-2"><p class="tw-font-semibold">Base Experience</p></div>
                            <div class="tw-col-span-2"><p>Coming Soon...</p></div>
                            <div class="tw-col-span-2"><p class="tw-font-semibold">Job Experience</p></div>
                            <div class="tw-col-span-2"><p>Coming Soon...</p></div>
                        </div>
                    </div>
                    <div class="tw-col-span-1 tw-flex tw-items-center tw-justify-center">
                        <img src="{{ $monster->animation }}" alt="">
                    </div>
                </div>

                <h2>Elemental Properties</h2>
                <div class="tw-grid tw-grid-cols-2 tw-gap-8">
                    <div class="tw-col-span-1">
                        <h3>Resistance</h3>
                        <div class="tw-grid tw-grid-cols-2">
                        @foreach($properties->strengths() as $key => $strength)
                            <p class="tw-col-span-1 element {{ $key }} tw-capitalize">{{ $key }} damage -{{ $strength }}%</p>
                        @endforeach
                        </div>
                    </div>
                    <div class="tw-col-span-1">
                        <h3>Weakness</h3>
                        <div class="tw-grid tw-grid-cols-2">
                            @foreach($properties->weaknesses() as $key => $weakness)
                                <p class="tw-col-span-1 element {{ $key }} tw-capitalize">{{ $key }} damage +{{ $weakness }}%</p>
                            @endforeach
                        </div>
                    </div>
                </div>


                <div class="section color-bg-gray tw--mx-10 tw-pb-8 tw-border-b tw-mt-8">
                    <div class="wave" style="height:47px; background: url('/img/layouts/wave-gray.png') no-repeat;"></div>
                    <div class="tw-px-10">
                        <h2>Quick Glance</h2>
                        <div class="tw-shadow tw-bg-white tw-p-4">
                            <div class="browsing-list tw-capitalize">
                                <p class="browsing-item">Monster Identifier: <b>#{{ $monster->id }}</b></p>
                                <p class="browsing-item">Monster DBName: <b>{{ $monster->dbname }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <h2>Drops Items</h2>
                    <div class="showcase">
                        @foreach ($monster->drops as $drop)
                            <a href="{{ route('database.item', $drop->item) }}">
                                <div class="show item">
                                    <img src="{{ $drop->item->image }}" alt="{{ $drop->item->name }}">
                                    <p>{{ $drop->item->name }}</p>
                                    <p>{{ $drop->rate }}%</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="section">
                    <h2>Spawn Locations</h2>
                    <div class="showcase">
                    @foreach ($monster->spawns as $spawn)
                        <div class="show">
                            <img src="{{ $spawn->map->image }}" alt="">
                            <p>{{ $spawn->mapname }}</p>
                            <p>{{ $spawn->amount }} Monsters</p>
                            <p>{{ $spawn->time }}</p>
                        </div>
                    @endforeach
                    </div>
                </div>

                <div class="section">
                    <h2>Stats</h2>
                </div>

                <!-- <div class="section">
                    <h2>Experience Yields</h2>
                </div> -->

                <div class="section">
                    <h2>AI Modes</h2>
                </div>
            </div>

            </div>
        </div>
    </div>
@endsection
