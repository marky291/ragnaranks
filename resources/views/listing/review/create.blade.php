@extends('layouts.profile')

@section('content')
    @if ($review->exists)
        <h2 class="heading">Review Editor</h2>
    @else
        <h2 class="heading">Review Creator</h2>
    @endif

    <create-review inline-template :model="{{$review}}">
        <section id="reviewCreator">
            <div id="comment-reply" class="create-reply tw-flex tw-items-center rounded tw-cursor-pointer">
                <div class="tw-flex tw-w-full tw-items-center">
                <span id="reply-action" class="tw-w-full">
                        <div class="py-3">
                            @if ($review->exists)
                                <p class="font-weight-bold tw-mb-1">Editing your review</p>
                                <p class="tw-text-gray-600 tw-mb-3">Make changes on your posted review, Don't let others influence your change.</p>
                            @else
                                <p class="font-weight-bold tw-mb-1">Writing your review</p>
                                <p class="tw-text-gray-600 tw-mb-3">Focus on being factual and objective. Don't use aggressive language and don't post personal details.</p>
                            @endif
                            <at-textarea ref="textarea" v-model.trim="review.message" min-rows="8" autosize placeholder="I have been playing this server for some time and I can say with confidence this is one of the ..." :class="validation.hasError('review.message') ? 'invalid-textarea' : ''"></at-textarea>
                            <div class="tw-flex tw-flex-row tw-mt-2">
                                <div v-if="validation.hasError('review.message')" class="tw-text-left tw-flex-1 help-block invalid-feedback">@{{ validation.firstError('review.message') }}</div>
                                <p v-if="messageCharactersRemaining > 0" class="tw-flex-1 tw-text-right help-block">@{{ messageCharactersRemaining }} characters remaining.</p>
                            </div>
                        </div>
                        <div class="tw-flex tw-flex-wrap tw-m-auto">
                            <div class="block">
                                <h3>Donations</h3>
                                <p>How reasonable were donation items for purchase and satisfaction when purchasing?</p>
                                <at-rate :show-text="true" :count="5" v-model="review.donation_score" class="tw-flex">
                                    <p class="tw-font-bold">@{{ ratingScore(review.donation_score) }}</p>
                                </at-rate>
                                <div v-if="validation.hasError('review.donation_score')" class="tw-text-left tw-pt-3 tw-flex-1 help-block invalid-feedback">@{{ validation.firstError('review.donation_score') }}</div>
                            </div>
                            <div class="block">
                                <h3>Updates</h3>
                                <p>How was experience with updates, quality and content during your time playing?</p>
                                <at-rate :show-text="true" :count="5" v-model="review.update_score" class="tw-flex">
                                    <p class="tw-font-bold">@{{ ratingScore(review.update_score) }}</p>
                                </at-rate>
                                <div v-if="validation.hasError('review.update_score')" class="tw-text-left tw-pt-3 tw-flex-1 help-block invalid-feedback">@{{ validation.firstError('review.update_score') }}</div>
                            </div>
                            <div class="block">
                                <h3>Class Experience</h3>
                                <p>How good was pvp/woe on this server, was it balanced?</p>
                                <at-rate :show-text="true" :count="5" v-model="review.class_score" class="tw-flex">
                                    <p class="tw-font-bold">@{{ ratingScore(review.class_score) }}</p>
                                </at-rate>
                                <div v-if="validation.hasError('review.class_score')" class="tw-text-left tw-pt-3 tw-flex-1 help-block invalid-feedback">@{{ validation.firstError('review.class_score') }}</div>
                            </div>
                            <div class="block">
                                <h3>Custom Items</h3>
                                <p>How balanced did you find custom items and did they improve gameplay?</p>
                                <at-rate :show-text="true" :count="5" v-model="review.item_score" class="tw-flex">
                                    <p class="tw-font-bold">@{{ ratingScore(review.item_score) }}</p>
                                </at-rate>
                                <div v-if="validation.hasError('review.item_score')" class="tw-text-left tw-pt-3 tw-flex-1 help-block invalid-feedback">@{{ validation.firstError('review.item_score') }}</div>
                            </div>
                            <div class="block">
                                <h3>Staff Support</h3>
                                <p>How quickly did the GMs help fix any issues that happened and what quality?</p>
                                <at-rate :show-text="true" :count="5" v-model="review.support_score" class="tw-flex">
                                    <p class="tw-font-bold">@{{ ratingScore(review.support_score) }}</p>
                                </at-rate>
                                <div v-if="validation.hasError('review.support_score')" class="tw-text-left tw-pt-3 tw-flex-1 help-block invalid-feedback">@{{ validation.firstError('review.support_score') }}</div>
                            </div>
                            <div class="block">
                                <h3>Server Hosting</h3>
                                <p>How good was the connection to the host and ping responsiveness?</p>
                                <at-rate :show-text="true" :count="5" v-model="review.hosting_score" class="tw-flex">
                                    <p class="tw-font-bold">@{{ ratingScore(review.hosting_score) }}</p>
                                </at-rate>
                                <div v-if="validation.hasError('review.hosting_score')" class="tw-text-left tw-pt-3 tw-flex-1 help-block invalid-feedback">@{{ validation.firstError('review.hosting_score') }}</div>
                            </div>
                            <div class="block">
                                <h3>Custom Content</h3>
                                <p>How well was custom content created and implemented on this server?</p>
                                <at-rate :show-text="true" :count="5" v-model="review.content_score" class="tw-flex">
                                    <p class="tw-font-bold">@{{ ratingScore(review.content_score) }}</p>
                                </at-rate>
                                <div v-if="validation.hasError('review.content_score')" class="tw-text-left tw-pt-3 tw-flex-1 help-block invalid-feedback">@{{ validation.firstError('review.content_score') }}</div>
                            </div>
                            <div class="block">
                                <h3>Events</h3>
                                <p>What was the event quality of the server by automated NPCs or by GMs?</p>
                                <at-rate :show-text="true" :count="5" v-model="review.event_score" class="tw-flex">
                                    <p class="tw-font-bold">@{{ ratingScore(review.event_score) }}</p>
                                </at-rate>
                                <div v-if="validation.hasError('review.event_score')" class="tw-text-left tw-pt-3 tw-flex-1 help-block invalid-feedback">@{{ validation.firstError('review.event_score') }}</div>
                            </div>
                        </div>
                        @if ($review->exists)
                        <at-button @click="updateReview('{{ route('listing.reviews.update', [$listing, $review]) }}')" type="primary" class="flex-fill" :loading="review.busy">Update my Review!</at-button>
                        @else
                        <at-button @click="postReview('{{ route('listing.reviews.store', $listing) }}')" type="primary" class="flex-fill" :loading="review.busy">Post my Review!</at-button>
                        @endif
                    </span>
                </span>
                </div>
            </div>
        </section>
    </create-review>
@endsection
