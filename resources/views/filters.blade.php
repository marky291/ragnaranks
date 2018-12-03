@extends('layouts.frame')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-8 py-4">

                @foreach($servers as $server)

                    @include('partials.card', ['server' => $server])

                @endforeach

            </div>

            <div id="sidebar" class="col-4">

                <div class="heading">
                    <h3>Search Filters</h3>
                </div>

                <div class="content">
                    Item
                </div>

            </div>

        </div>

    </div>

@endsection