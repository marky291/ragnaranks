@extends('layouts.frame')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-8 py-5">

                @foreach($servers as $server)

                    @include('partials.card', ['server' => $server])

                @endforeach

            </div>

            <div id="sidebar" class="col-4 py-5">

                <div class="content">
                    <h3 class="mb-0">Filters</h3>
                    <small class="subheading">Narrow down your search with a filter ^_^</small>

                    <h4 class="text-green mb-0 mt-2">Modes</h4>
                    <ul class="list-unstyled pl-3 my-2 border-left-green-1 background-green-faded">
                        @foreach(\App\ServerMode::all() as $mode)
                            <li>{{ ucfirst($mode->name) }}</li>
                        @endforeach
                    </ul>

                    <h4 class="text-green">Tags</h4>
                    <ul class="list-unstyled pl-3 my-2 border-left-green-1 background-green-faded">
                        @foreach(\App\Tag::all() as $tag)
                            <li>{{ ucfirst($tag->name) }}</li>
                        @endforeach
                    </ul>

                    <h4 class="text-green">Rates</h4>
                    <ul class="list-item list-unstyled pl-3 my-2 border-left-green-1 background-green-faded">
                        <li>Official Rate</li>
                        <li>Low Rate</li>
                        <li>Mid Rate</li>
                        <li>High Rate</li>
                        <li>Super Rate</li>
                        <li>Instant Rate</li>
                    </ul>
                </div>

                <div class="heading">
                    <h3>Newest Entries</h3>
                </div>
                <div class="content">
                    <h3 class="mb-0">Servers</h3>
                    <small class="subheading">The newest additions added to our site.</small>
                </div>

            </div>

        </div>

    </div>

@endsection