<script>

    import _ from 'lodash';
    import Review from './ReviewComponent.vue';
    import { Form, HasError, AlertError } from 'vform';

    export default {

        props: ['data', 'policy'],

        components: {
            Review,
            'has-error': HasError,
            'alert-error': AlertError,
        },

        data: function() {
            return {
                activated: false,
                collection: this.data,
                reviewable: true,
                isCreatingReview: false,

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
            postReview(url) {
                this.reviewable = false;
                this.review.post(url).then(response => {
										this.$Message.success('Review has been posted, thank you!');
										this.collection.push(response.data.review);
                    this.$parent.setView('listing');
								}).catch(error => {
                    this.$Message.error(error.message);
								});
                //this.collection.push(review);
                this.emitReviewScores();
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