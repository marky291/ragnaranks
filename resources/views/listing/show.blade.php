@extends('layouts.frame')

@section('content')

    <?php /** @var \App\Listings\Listing $listing */ ?>
    <?php /** @var \App\Tag $tag */ ?>

    <listing-profile-old voted="{{ $listing->votes()->hasClientInteractedWith(config('interaction.vote.spread')) }}" clicked="{{ $listing->clicks()->hasClientInteractedWith(config('interaction.click.spread')) }}" inline-template>
        <div class="">
            <div class="container mt-3">
                <div class="row">
                    <div id="sidebar" class="col-4 py-5">
                        @component('layouts.sidebar')
                            <div class="heading">
                                <h3>User Actions</h3>
                            </div>
                            <div id="user-actions" class="content py-0 rounded py-3 d-flex flex-column">
                                <at-button class="mb-2" type="primary" hollow>Back to Searching</at-button>
                                <at-button class="mb-2" hollow>Visit Website</at-button>
                                <span v-if="!theCurrentViewIs('voting')">
                                    <at-button @click="setView('voting')" class="w-100 mb-2" hollow>Vote for server</at-button>
                                </span>
                                <span v-else>
                                    <at-button @click="setView('listing')" type="error" class="w-100 mb-2" hollow>Back to Listing</at-button>
                                </span>
                                <span v-if="!theCurrentViewIs('reviewing')">
                                    <at-button @click="setView('reviewing')" type="success" class="w-100" hollow>Create a review</at-button>
                                </span>
                                <span v-else>
                                    <at-button @click="setView('listing')" type="error" class="w-100" hollow>Back to Listing</at-button>
                                </span>
                            </div>
                        @endcomponent
                    </div>
                    <div class="col-8 py-5">
                        @include('listing.profile')
                    </div>
                </div>
            </div>
        </div>
    </listing-profile-old>

@endsection
