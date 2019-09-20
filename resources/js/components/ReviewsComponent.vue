<template>
		<section id="reviews" class="tw-px-10 pb-4">
			<h3 class="heading tw-py-4 mb-4 tw-font-bold text-dark heading-underline tw-capitalize">{{ $t('profile.reviews.heading')}}</h3>
			<div v-if="reviews && reviews.length > 0">
				<div v-for="(review, i) in reviews">
					<review :review="review" :key="i"></review>
				</div>
			</div>
			<div v-else>
				<div class="tw-flex tw-items-center" id="review-enticement-img">
				</div>
			</div>
		</section>
</template>

<script>
    import Review from './ReviewComponent.vue';

    export default {
        props: ['reviews'],
        components: {
            Review,
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
