@extends('errors::illustrated-layout')

@section('code', '503')
@section('title', __('Service Unavailable'))

@section('image')
    <div style="background-image: url({{ asset('/svg/503.png') }}); background-size:contain; background-position:center;" class="absolute pin bg-no-repeat md:bg-left lg:bg-center"></div>
@endsection

@section('message', __($exception->getMessage() ?: 'We are implementing some important changes, check back later!'))
