@extends('layouts.frame')

@section('content')
    <div class="shadow-inner">
        <div class="container">
            <div class="row">
                <div id="sidebar" class="col-4 py-5">
                    @component('layouts.sidebar')
                        <div class="heading">
                            <h3>Filtered Search</h3>
                        </div>
                        <filtered-search :tags="{{ $tags }}"></filtered-search>
                    @endcomponent
                </div>
                <div class="col-8 py-5">
                    <filtered-listings :initial-listings="{{ $listings }}"></filtered-listings>

{{--                    @foreach($listings as $listing)--}}
{{--                        @if ($loop->first)--}}
{{--                            {{ $listing }}--}}
{{--                        @endif--}}
{{--                        <div class="mb-4">--}}
{{--                            @include('partials.cards.normal', ['listing' => $listing])--}}
{{--                        </div>--}}
{{--                    @endforeach--}}

                </div>

            </div>

        </div>
    </div>

@endsection