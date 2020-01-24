@extends('layouts.profile')

@section('meta_tags')
    <!-- Primary Meta Tags -->
    <title>{{ $listing->name }} Vote Dispatcher</title>
    <meta name="title" content="{{ $listing->name }} Vote Dispatcher">
    <meta name="description" content="Vote for {{ $listing->name }} and help to stand out">
    <meta name="keywords" content="vote,vote4points">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url($listing->route() . '/votes') }}">
    <meta property="og:title" content="{{ $listing->name }} Vote Dispatcher">
    <meta property="og:description" content="Vote for {{ $listing->name }} and help to stand out">
    <meta property="og:image" content="{{ \Illuminate\Support\Facades\Storage::url($listing->background) }}">
@endsection

@section('content')
    <voting v-on:voted="votes++" inline-template listing-name="{{ $listing->name }}" listing-slug="{{ $listing->slug }}">
        <section id="voting">
            <h3 class="heading mb-4 tw-font-bold heading-underline tw-tracking-tighter">@{{ messages.heading }}</h3>
            <div class="row no-gutters">
                <p class="tw-font-bold mb-3" :class="availableVotes > 0 ?'tw-text-green':'tw-text-red'">@{{ $t('profile.voting.spending', {value: availableVotes}) }}</p>
                <p class="mb-3">@{{ messages.content }}</p>

                <div v-if="availableVotes > 0">
                    <google-re-captcha-v3
                        ref="captcha" v-model="gRecaptchaResponse"
                        :site-key="'6LdT_aMUAAAAANYwPoNyZ4eaFX2kqZHi4wZTySp9'"
                        :id="'vote_id'"
                        :inline="false"
                        :action="'vote'">
                    </google-re-captcha-v3>

                    <at-button @click="sendVote()" type="primary" class="mt-2 tw-h-10 tw-w-full">Vote for @{{ listingName }}</at-button>
                </div>
            </div>
        </section>
    </voting>
@endsection
