@extends('partials.layout')

@section('content')

    <div class="row">

        <div class="col-9">

            @foreach($servers as $server)
                <div class="card border mb-3">
                    <div class="card-header">{{ $server->name }}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $server->description }}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <h3>In Votes: {{ $server->votes->count() }}</h3>
                        <h3>Out Clicks: {{ $server->clicks->count() }}</h3>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="col-3">
            Sidebar
        </div>
    </div>
@endsection