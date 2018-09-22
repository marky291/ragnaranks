@extends('partials.layout')

@section('content')

    <div class="row">

        <div class="col-10">
            @each('partials.cards', $servers, 'server')
        </div>

        <div class="col-2 sidebar no-gutters">
            <h3>Filters</h3>
            <h5>Sorting</h5>
            <ul>
                <li>Trending</li>
                <li><a href="{{ route('filter.index') }}">Most Voted</a></li>
                <li>New Entries</li>
                <li>Most Clicked</li>
                <li>Episode Version</li>
            </ul>
            <h5>Server Types</h5>
            <ul>
                <li>Role Playing</li>
                <li>Player Killing</li>
            </ul>
            <h5>Server Modes</h5>
            <ul>
                <li>Renewal Mode</li>
                <li>Pre-Renewal Mode</li>
            </ul>
            <h5>Server Rates</h5>
            <ul>
                <li>Low Rate</li>
                <li>Medium Rate</li>
                <li>High Rate</li>
                <li>Instant Level</li>
            </ul>
        </div>

    </div>

@endsection