<template>
		<section v-if="false" id="reviews" class="tw-px-10">
			<h3 class="heading tw-py-4 mb-4 tw-font-bold text-dark heading-underline">Player Reviews</h3>
			<div v-for="(review, index) in collection">
				<review :review="review"></review>
			</div>
		</section>
</template>

<script>
    import Review from './ReviewComponent.vue';

    export default {
        props: ['data', 'policy'],
        components: {
            Review
        },
        data: function() {
            return {
                activated: false,
                collection: this.data,
                reviewable: true,
                isCreatingReview: false
            }
        },
        created: function() {
            this.$root.$on('toggle:review', (param) => {
                this.changeReviewState();
            });
            this.emitReviewScores();
        },
        methods: {
            emitReviewScores() {
                this.$root.$emit('update:scoreboard', {
                    donation_score: this.getAverageOfCollection('donation_score'),
                    update_score: this.getAverageOfCollection('update_score'),
                    class_score: this.getAverageOfCollection('class_score'),
                    item_score: this.getAverageOfCollection('item_score'),
                    support_score: this.getAverageOfCollection('support_score'),
                    hosting_score: this.getAverageOfCollection('hosting_score'),
                    content_score: this.getAverageOfCollection('content_score'),
                    event_score: this.getAverageOfCollection('event_score'),
                });
            },
            getAverageOfCollection(element) {
                return _.meanBy(this.collection, function(item) {
                    return item[element];
                });
            },
            Rounded(number) {
                if (Math.round(number)) return Math.round(number); else return 0;
            },
            remove(index) {
                this.collection.splice(index, 1);
                this.emitReviewScores();
            },
            changeReviewState() {
                this.$root.$emit('creating:review', this.isCreatingReview = !this.isCreatingReview);
                if (this.isCreatingReview) {
                    this.$Message("Your time spent reviewing this server listing is appreciated and helps others");
                    setTimeout(() => {
                        this.$refs.textarea.focus()
                    })
                }
            },
            ReviewsExist() {
                return count(this.collection);
            },
						hasReviews() {
								return false;
						}
        }
    }

</script>

<style>
    .at-rate__list {
        padding-left:0;
        margin-bottom: 0;
    }
</style>