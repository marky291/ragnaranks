@extends('layouts.frame')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-8 py-4">

                <div id="filter" class="d-flex mb-4">
                    <h3 class="w-15 d-flex align-items-center mb-0 mr-2 text-orange">Looking for</h3>

                    <select class="form-control-sm mr-2">
                        <option value="all">Any Rates</option>
                        <option value="">Official Rates</option>
                        <option value="">Low Rates</option>
                        <option value="">Mid Rates</option>
                        <option value="">High Rates</option>
                        <option value="">Super Rates</option>
                        <option value="">Instant Rates</option>
                    </select>

                    <select class="form-control-sm mr-2">
                        <option value="all">Any Mode</option>
                        @foreach(\App\ServerMode::all() as $mode)
                            <option value="">{{ ucfirst($mode->name) }} Mode</option>
                        @endforeach
                    </select>

                    <select class="form-control-sm mr-2">
                        <option value="all">With Any Tags</option>
                        @foreach(\App\Tag::all() as $tag)
                            <option>With {{ ucfirst($tag->name) }}</option>
                        @endforeach
                    </select>

                    <select class="form-control-sm flex-fill">
                        <option>Sort by Score</option>
                        <option>Sort by Rank Position</option>
                        <option>Sort by Date added</option>
                        <option>Sort by Online since</option>
                    </select>
                </div>

                @foreach($servers as $server)

                    @include('partials.card', ['server' => $server])

                @endforeach

            </div>

            <div id="sidebar" class="col-4 py-4">

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