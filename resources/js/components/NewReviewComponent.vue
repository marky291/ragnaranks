<template>
    <div @click="changeReviewState()" id="comment-reply" class="tw-mt-4 create-reply tw-flex tw-items-center rounded tw-cursor-pointer">
        <div class="tw-p-4 tw-flex tw-w-full tw-items-center">
<!--            <div class="tw-rounded-full tw-h-16 tw-w-16 tw-flex avatar-circle tw-items-center tw-justify-center tw-mr-6 tw-bg-grey">-->
<!--                <img class="tw-rounded-full avatar-circle" src="//www.gravatar.com/avatar/c2d52abc9f91d455e15a48d59fecd746?s=100&amp;d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fdefault-square-avatar.jpg" alt="">-->
<!--            </div>-->
            <span v-if="isCreatingReview" id="reply-action" class="tw-w-full">
                <div class="row">
                    <div class="col-12 tw-mb-5">
                        <h3 class="heading tw-mb-1 text-dark heading-underline">You are writing a <span class="tw-text-blue">Review</span></h3>
                        <p class="tw-text-grey-dark tw-mb-5">Focus on being factual and objective. Don't use aggressive language and don't post personal details...</p>
                        <at-textarea v-model="review_input" min-rows="8" autosize placeholder="Your experience, Your review"></at-textarea>
                    </div>
                    <div class="col-12 row tw-mb-5">
                        <div class="col-6">
                            <div class="tw-p-2 tw-rounded tw-mb-4">
                                <p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Donation Experience</p>
                                <p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience against non-donators</p>
                                <at-rate :show-text="true" :count="5" v-model="form.donation_score" class="tw-flex">
                                    <p class="tw-font-bold">{{ ratingScore(form.donation_score) }}</p>
                                </at-rate>
                            </div>

                            <div class="tw-p-2 tw-rounded tw-mb-4">
                                <p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Update Experience</p>
                                <p class="tw-text-xs tw-mb-2 tw-text-grey-darker">Are updates regular with positive effect on the server</p>
                                <at-rate :show-text="true" :count="5" v-model="form.update_score" class="tw-flex">
                                    <p class="tw-font-bold">{{ ratingScore(form.update_score) }}</p>
                                </at-rate>
                            </div>

                            <div class="tw-p-2 tw-rounded tw-mb-4">
                                <p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Class Experience</p>
                                <p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience against non-donators</p>
                                <at-rate :show-text="true" :count="5" v-model="form.class_score" class="tw-flex">
                                    <p class="tw-font-bold">{{ ratingScore(form.class_score) }}</p>
                                </at-rate>
                            </div>

                            <div class="tw-p-2 tw-rounded tw-mb-4">
                                <p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Item Experience</p>
                                <p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience against non-donators</p>
                                <at-rate :show-text="true" :count="5" v-model="form.item_score" class="tw-flex">
                                    <p class="tw-font-bold">{{ ratingScore(form.item_score) }}</p>
                                </at-rate>
                            </div>
                        </div>
                        <div class="col-6">

                            <div class="tw-p-2 tw-rounded tw-mb-4">
                                <p class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Support Experience</p>
                                <p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience against non-donators</p>
                                <at-rate :show-text="true" :count="5" v-model="form.support_score" class="tw-flex">
                                    <p class="tw-font-bold">{{ ratingScore(form.support_score) }}</p>
                                </at-rate>
                            </div>

                            <div class="tw-p-2 tw-rounded tw-mb-4">
                                <h4 class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Hosting Experience</h4>
                                <p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience against non-donators</p>
                                <at-rate :show-text="true" :count="5" v-model="form.hosting_score" class="tw-flex">
                                    <p class="tw-font-bold">{{ ratingScore(form.hosting_score) }}</p>
                                </at-rate>
                            </div>

                            <div class="tw-p-2 tw-rounded tw-mb-4">
                                <h4 class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Content Experience</h4>
                                <p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience against non-donators</p>
                                <at-rate :show-text="true" :count="5" v-model="form.content_score" class="tw-flex">
                                    <p class="tw-font-bold">{{ ratingScore(form.content_score) }}</p>
                                </at-rate>
                            </div>

                            <div class="tw-p-2 tw-rounded tw-mb-4">
                                <h4 class="tw-text-sm heading tw-text-grey-darkest tw-mb-1 tw-font-semibold">Event Experience</h4>
                                <p class="tw-text-xs tw-mb-2 tw-text-grey-darker">How did you find the experience against non-donators</p>
                                <at-rate :show-text="true" :count="5" v-model="form.event_score" class="tw-flex">
                                    <p class="tw-font-bold">{{ ratingScore(form.event_score) }}</p>
                                </at-rate>
                            </div>
                        </div>
                    </div>
                </div>
                <at-button type="primary" class="flex-fill">Post my Review!</at-button>
            </span>
            <at-button v-else>Create a review for this server!</at-button>
        </div>
    </div>
</template>

<style>
    .invalid-feedback:empty {
        display: none !important;
    }
    .invalid-feedback {
        display: block !important;
    }
</style>
<script>

    class Errors {
        constructor() {
            this.errors = {};
        }
        get(field) {
            if (this.errors[field]) {
                return this.errors[field][0];
            }
        }
        record(errors) {
            this.errors = errors;
        }
        clear(field) {
            console.log(field);
            delete this.errors[field];
        }
        any() {
            return Object.keys(this.errors).length > 0;
        }
    }

    export default {

        data() {
            return {

                isCreatingReview: false,

                form: {
                    review_input: "",
                    donation_score: 5,
                    update_score: 5,
                    class_score: 5,
                    item_score: 5,
                    support_score: 5,
                    hosting_score: 5,
                    content_score: 5,
                    event_score: 5,
                },

                default: {
                    message: "",
                    donation_score: 5,
                    update_score: 5,
                    class_score: 5,
                    item_score: 5,
                    support_score: 5,
                    hosting_score: 5,
                    content_score: 5,
                    event_score: 5,
                },

                errors: new Errors(),

                endpoint: window.location.href + "/reviews",

                options: [
                    { text: '0', value: 0 },
                    { text: '1', value: 1 },
                    { text: '2', value: 2 },
                    { text: '3', value: 3 },
                    { text: '4', value: 4 },
                    { text: '5', value: 5 },
                    { text: '6', value: 6 },
                    { text: '7', value: 7 },
                    { text: '8', value: 8 },
                    { text: '9', value: 9 },
                    { text: '10', value: 10 },
                ],
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
            addReview() {
                axios.post(this.endpoint, this.form)
                    .then(response => {
                        this.$emit('review-created', this.form);
                        flash("Your review has been posted.");
                        this.form = this.default;
                    }).catch(error => this.errors.record(error.response.data.errors));
            },
            changeReviewState() {
                this.$Message("Your time spent reviewing this server listing is appreciated and helps others");
                this.$root.$emit('creating:review', this.isCreatingReview = !this.isCreatingReview);
                this.$Message("CreatingReview" + this.isCreatingReview);
                setTimeout(() => {
                    // this.$refs.input.focus()
                })
            },
        }
    }

</script>

<style>
    .at-rate__list {
        padding-left:0;
        margin-bottom: 0;
    }
</style>