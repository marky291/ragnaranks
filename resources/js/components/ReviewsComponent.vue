<template>

    <div class="">
<!--        <div v-for="(review, index) in collection">-->
<!--            <review :data="review"></review>-->
<!--        </div>-->

        <div v-if="reviewable" @review-created="addReview" @click="changeReviewState()" id="comment-reply" class="tw-mt-4 create-reply tw-flex tw-items-center rounded tw-cursor-pointer">
            <div class="tw-p-4 tw-flex tw-w-full tw-items-center">
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
                <at-button v-else>
                    <span v-if="ReviewsExist">
                        Create a review for this server!
                    </span>
                    <span v-else>
                        Be the first to create a review for this server!
                    </span>
                </at-button>
            </div>
        </div>

    </div>

</template>

<script>

    import Review from './ReviewComponent.vue';
    import NewReview from '../components/NewReviewComponent.vue';

    export default {

        props: ['data', 'policy'],

        components: { Review },

        data: function() {
            return {
                activated: false,
                collection: this.data,
                reviewable: true,

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

                endpoint: window.location.href + "/reviews",
            }
        },

        created: function() {
            this.CalculateAverages();
            console.log("Reviewable policy vue.js");
        },

        methods: {
            CalculateAverages() {
                Event.$emit('update:avg-donation-score', this.Rounded(_.meanBy(this.collection, function(item) { return Math.round(item.donation_score); })));
                Event.$emit('update:avg-update-score', this.Rounded(_.meanBy(this.collection, function(item) { return Math.round(item.update_score); })));
                Event.$emit('update:avg-class-score', this.Rounded(_.meanBy(this.collection, function(item) { return item.class_score; })));
                Event.$emit('update:avg-item-score', this.Rounded(_.meanBy(this.collection, function(item) { return item.item_score; })));
                Event.$emit('update:avg-support-score', this.Rounded(_.meanBy(this.collection, function(item) { return item.support_score; })));
                Event.$emit('update:avg-hosting-score', this.Rounded(_.meanBy(this.collection, function(item) { return item.hosting_score; })));
                Event.$emit('update:avg-content-score', this.Rounded(_.meanBy(this.collection, function(item) { return item.content_score; })));
                Event.$emit('update:avg-event-score', this.Rounded(_.meanBy(this.collection, function(item) { return item.event_score; })));
            },

            Rounded(number) {
                var value = Math.round(number);

                if (value)
                    return value;

                return 0;
            },

            remove(index) {
                this.collection.splice(index, 1);
                this.CalculateAverages();
            },

            addReview(review) {
                this.reviewable = false;
                this.collection.push(review);
                this.CalculateAverages();
            },
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
                //
            },
            changeReviewState() {
                this.$Message("Your time spent reviewing this server listing is appreciated and helps others");
                this.$root.$emit('creating:review', this.isCreatingReview = !this.isCreatingReview);
                this.$Message("CreatingReview" + this.isCreatingReview);
                setTimeout(() => {
                    // this.$refs.input.focus()
                })
            },
            ReviewsExist() {
                return count(this.collection);
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