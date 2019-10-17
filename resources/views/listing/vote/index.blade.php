@extends('layouts.profile')

@section('content')
    <voting v-on:voted="votes++" inline-template listing-name="{{ $listing->name }}" listing-slug="{{ $listing->slug }}">
        <section id="voting">
            <h3 class="heading mb-4 tw-font-bold heading-underline tw-tracking-tighter">@{{ messages.heading }}</h3>
            <div class="row no-gutters tw-my-4">
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-2280364578236676"
                     data-ad-slot="6899563036"
                     data-ad-format="auto"
                     data-full-width-responsive="true">
                 </ins>
            </div>
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
