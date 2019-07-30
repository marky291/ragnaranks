<template>
		<section id="reviewCreator" class="tw-px-10 pt-4 pb-3 mb-3">
			<div id="comment-reply" class="create-reply tw-flex tw-items-center rounded tw-cursor-pointer">
				<div class="tw-flex tw-w-full tw-items-center">
							<span id="reply-action" class="tw-w-full">
									<div class="py-3">
										<h3 class="heading mb-4 tw-font-bold heading-underline tw-tracking-tight">You are creating a <span class="tw-text-blue">Review</span></h3>
										<p class="font-weight-bold tw-mb-1" :style="validation.hasError('review.message') ? 'color:#b3312d' : null">Write your Experience, Write your Review</p>
										<p class="tw-text-grey-dark tw-mb-3">Focus on being factual and objective. Don't use aggressive language and don't post personal details...</p>
										<at-textarea ref="textarea" v-model.trim="review.message" min-rows="8" autosize placeholder="I have been playing this server for some time and I can say with confidence this is one of the ..." :class="validation.hasError('review.message') ? 'invalid-textarea' : ''"></at-textarea>
										<div v-if="validation.hasError('review.message')" class="tw-flex-1 tw-text-right help-block invalid-feedback">{{ validation.firstError('review.message') }}</div>
										<p v-if="messageCharactersRemaining > 0" class="tw-flex-1 tw-text-right help-block">{{ messageCharactersRemaining }} characters remaining.</p>
									</div>
									<div class="row tw-mb-5">
										<div class="col-6">
											<div class="tw-p-2 tw-rounded tw-mb-4">
												<p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Donations</p>
												<p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience against non-donators on the server?</p>
												<at-rate :show-text="true" :count="5" v-model="review.donation_score" class="tw-flex">
													<p class="tw-font-bold">{{ ratingScore(review.donation_score) }}</p>
												</at-rate>
											</div>

											<div class="tw-p-2 tw-rounded tw-mb-4">
												<p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Updates</p>
												<p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the updates and their effects on the server?</p>
												<at-rate :show-text="true" :count="5" v-model="review.update_score" class="tw-flex">
													<p class="tw-font-bold">{{ ratingScore(review.update_score) }}</p>
												</at-rate>
											</div>

											<div class="tw-p-2 tw-rounded tw-mb-4">
												<p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Class Experience</p>
												<p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the class diversity and balance on the server?</p>
												<at-rate :show-text="true" :count="5" v-model="review.class_score" class="tw-flex">
													<p class="tw-font-bold">{{ ratingScore(review.class_score) }}</p>
												</at-rate>
											</div>

											<div class="tw-p-2 tw-rounded tw-mb-4">
												<p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Custom Items</p>
												<p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the item balance and customization on the server?</p>
												<at-rate :show-text="true" :count="5" v-model="review.item_score" class="tw-flex">
													<p class="tw-font-bold">{{ ratingScore(review.item_score) }}</p>
												</at-rate>
											</div>
										</div>
										<div class="col-6">

											<div class="tw-p-2 tw-rounded tw-mb-4">
												<p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Staff Support</p>
												<p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience of reaching the Staff and their support of the server?</p>
												<at-rate :show-text="true" :count="5" v-model="review.support_score" class="tw-flex">
													<p class="tw-font-bold">{{ ratingScore(review.support_score) }}</p>
												</at-rate>
											</div>

											<div class="tw-p-2 tw-rounded tw-mb-4">
												<h4 class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Server Latency</h4>
												<p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the latency on the server?</p>
												<at-rate :show-text="true" :count="5" v-model="review.hosting_score" class="tw-flex">
													<p class="tw-font-bold">{{ ratingScore(review.hosting_score) }}</p>
												</at-rate>
											</div>

											<div class="tw-p-2 tw-rounded tw-mb-4">
												<h4 class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Custom Content</h4>
												<p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the overall customization of the server?</p>
												<at-rate :show-text="true" :count="5" v-model="review.content_score" class="tw-flex">
													<p class="tw-font-bold">{{ ratingScore(review.content_score) }}</p>
												</at-rate>
											</div>

											<div class="tw-p-2 tw-rounded tw-mb-4">
												<h4 class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Events</h4>
												<p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the eventfulness of automated and/or GM hosted events on the server?</p>
												<at-rate :show-text="true" :count="5" v-model="review.event_score" class="tw-flex">
													<p class="tw-font-bold">{{ ratingScore(review.event_score) }}</p>
												</at-rate>
											</div>
										</div>
									</div>
								<at-button @click="postReview" type="primary" class="flex-fill">Post my Review!</at-button>
							</span>
				</div>
			</div>
		</section>
</template>

<script>
    import { Form, HasError, AlertError } from 'vform';
		import {Validator} from 'simple-vue-validator';

    export default {
    		props: ['listing-slug'],
        components: {
            'has-error': HasError,
            'alert-error': AlertError,
        },
        data: function() {
            return {
                review: new Form({
                    message: "",
                    donation_score: 3,
                    update_score: 3,
                    class_score: 3,
                    item_score: 3,
                    support_score: 3,
                    hosting_score: 3,
                    content_score: 3,
                    event_score: 3,
                })
            }
        },
			computed: {
				messageCharactersRemaining() {
					return 200 - this.review.message.length;
				}
			},
			methods: {
				ratingScore(score) {
					if (score === 5)
						return 'Excellent';
					if (score === 4)
						return 'Good';
					if (score === 3)
						return 'Ok';
					if (score === 2)
						return 'Bad';
					if (score === 1)
						return 'Terrible'
				},
				postReview: function () {
					this.review.post(`/listing/${this.listingSlug}/reviews`).then((response) => {
						if (response.data.success === true) {
							this.$Message.success(response.data.message);
							this.$emit('review:created', response.data.review);
						} else {
							this.$Message.error(response.data.message);
						}
					}).catch(response => {
						this.$Message.error(response.message);
					});
				},
			},
			validators: {
    			'review.message': function(value) {
						return Validator.value(value).required().minLength(200);
					}
			}
    }
</script>