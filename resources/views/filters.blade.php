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
                <li><a href="{{ filter_query('all', 'all', 'votes_count', 'desc') }}#filters">Most Voted</a></li>
                <li><a href="{{ filter_query('all', 'all', 'created_at', 'desc') }}#filters">Oldest Servers</a></li>
                <li><a href="{{ filter_query('all', 'all', 'clicks_count', 'desc') }}#filters">Most Clicked</a></li>
                <li><a href="{{ filter_query('all', 'all', 'episode', 'desc') }}#filters">Episode Version</a></li>
                <li><a href="{{ filter_query('all', 'all', 'created_at', 'asc') }}#filters">Newest Servers</a></li>
            </ul>
            <h5>Server Types</h5>
            <ul>
                <li>Role Playing</li>
                <li>Player Killing</li>
            </ul>
            <h5>Server Modes</h5>
            <ul>
                <li><a href="{{ filter_query('all', 'renewal', 'votes_count', 'desc') }}#filters">Renewal Mode</a></li>
                <li><a href="{{ filter_query('all', 'pre-renewal', 'votes_count', 'desc') }}#filters">Pre-Renewal Mode</a></li>
                <li><a href="{{ filter_query('all', 'classic', 'votes_count', 'desc') }}#filters">Classic Mode</a></li>
                <li><a href="{{ filter_query('all', 'custom', 'votes_count', 'desc') }}#filters">Custom Mode</a></li>
            </ul>
            <h5>Server Rates</h5>
            <ul>
                <li><a href="{{ filter_query('low-rate', 'all', 'votes_count', 'desc') }}#filters">Low Rate</a></li>
                <li><a href="{{ filter_query('mid-rate', 'all', 'votes_count', 'desc') }}#filters">Mid Rate</a></li>
                <li><a href="{{ filter_query('high-rate', 'all', 'votes_count', 'desc') }}#filters">High Rate</a></li>
            </ul>
        </div>

    </div>

@endsection