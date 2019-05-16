<script>

    import _ from 'lodash';
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
            addReview(review) {
                this.reviewable = false;
                this.collection.push(review);
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