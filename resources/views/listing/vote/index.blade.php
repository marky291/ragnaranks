@extends('layouts.profile')

@section('content')
    <voting v-on:voted="votes++" inline-template listing-name="{{ $listing->name }}" listing-slug="{{ $listing->slug }}">
        <section id="voting">
            <h3 class="heading mb-4 tw-font-bold heading-underline tw-tracking-tighter">Vote 4 Points <i class="tw-underline">QuickVote</i></h3>
            <div class="row no-gutters">
                @if($status == true)
                    <p class="tw-font-bold mb-3 tw-text-green-500 tw-text-lg">You have successfully voted on this server with the ip address {{ request()->getClientIp() }}</p>
                @else
                    <p class="tw-font-bold mb-3 tw-text-red-500 tw-text-lg">Sorry your IP address {{ request()->getClientIp() }} has already made a vote towards this listing within the last {{ config('action.vote.spread') }} hours</p>
                @endif
                <p class="mb-3">Quickvote allows you to automatically vote just by visiting this link from the vote for points module, we track incoming requests using the client IP, and the referring link request, this ensure that the click is coming from a sincere implementation of the vote4points module and that each vote holds its value without spam.</p>
                <a href="https://www.m.me/ragnaranks"><i class="fab fa-facebook-square"></i> Contact our Facebook Page for Help</a>
            </div>
        </section>
    </voting>
@endsection
