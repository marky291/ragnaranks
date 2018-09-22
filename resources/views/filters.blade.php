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
                <li><a href="{{ route('filter.votes', 30) }}#filters">Most Voted</a></li>
                <li><a href="{{ route('filter.creation', 'desc') }}#filters">Oldest Servers</a></li>
                <li><a href="{{ route('filter.clicks', 30) }}#filters">Most Clicked</a></li>
                <li><a href="{{ route('filter.episode', 'desc') }}#filters">Episode Version</a></li>
                <li><a href="{{ route('filter.creation', 'asc') }}#filters">Newest Servers</a></li>
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
                <li><a href="{{ route('filter.expGroup', ['exp_group' => 'low-rate', 'order' => 'desc']) }}">Low Rate</a></li>
                <li><a href="{{ route('filter.expGroup', ['exp_group' => 'mid-rate', 'order' => 'desc']) }}">Medium Rate</a></li>
                <li><a href="{{ route('filter.expGroup', ['exp_group' => 'high-rate', 'order' => 'desc']) }}">High Rate</a></li>
            </ul>
        </div>

    </div>

@endsection