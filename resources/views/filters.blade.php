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
                <li><a href="{{ filter_query('all', 'all', 'rank', 'asc') }}#filters">Server Ranking</a></li>
                <li><a href="{{ filter_query('all', 'all', 'votes_count', 'desc') }}#filters">Most Voted</a></li>
{{--                <li><a href="{{ filter_query('all', 'all', 'created_at', 'desc') }}#filters">Oldest Servers</a></li>--}}
                <li><a href="{{ filter_query('all', 'all', 'clicks_count', 'desc') }}#filters">Most Clicked</a></li>
                <li><a href="{{ filter_query('all', 'all', 'episode', 'desc') }}#filters">Episode Version</a></li>
{{--                <li><a href="{{ filter_query('all', 'all', 'created_at', 'asc') }}#filters">Newest Servers</a></li>--}}
            </ul>
            <h5>Server Types</h5>
            <ul>
                @foreach(\App\Tag::all() as $tag)
                    <li><a href="#" title="{{ $tag->description }}">{{ $tag->name }}</a></li>
                @endforeach
            </ul>
            <h5>Server Modes</h5>
            <ul>
                <li><a href="{{ filter_query('all', 'renewal', 'rank', 'asc') }}#filters">Renewal Mode</a></li>
                <li><a href="{{ filter_query('all', 'pre-renewal', 'rank', 'asc') }}#filters">Pre-Renewal Mode</a></li>
                <li><a href="{{ filter_query('all', 'classic', 'rank', 'asc') }}#filters">Classic Mode</a></li>
                <li><a href="{{ filter_query('all', 'custom', 'rank', 'asc') }}#filters">Custom Mode</a></li>
            </ul>
            <h5>Server Rates</h5>
            <ul>
                <li><a href="{{ filter_query('low-rate', 'all', 'rank', 'asc') }}#filters">Low Rate</a></li>
                <li><a href="{{ filter_query('mid-rate', 'all', 'rank', 'asc') }}#filters">Mid Rate</a></li>
                <li><a href="{{ filter_query('high-rate', 'all', 'rank', 'asc') }}#filters">High Rate</a></li>
            </ul>
        </div>

    </div>

@endsection