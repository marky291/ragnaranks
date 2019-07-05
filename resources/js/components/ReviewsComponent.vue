<template>
		<section v-if="false" id="reviews" class="tw-px-10">
			<h3 class="heading tw-py-4 mb-4 tw-font-bold text-dark heading-underline">Player Reviews</h3>
			<div v-for="(review, index) in reviews">
				<review :review="review"></review>
			</div>
		</section>
</template>

<script>
    import Review from './ReviewComponent.vue';

    export default {
        props: ['reviews'],
        components: {
            Review
        },
        data: function() {
            return {
                activated: false,
                reviewable: true,
                isCreatingReview: false
            }
        },
        created: function() {
            this.$root.$on('toggle:review', (param) => {
                this.changeReviewState();
            });
        },
        methods: {
            remove(index) {
                this.collection.splice(index, 1);
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