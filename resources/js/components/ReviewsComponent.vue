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
            // this.CalculateAverages();
            console.log("Reviewable policy vue.js");

            this.$root.$on('toggle:review', (param) => {
                this.changeReviewState();
            });
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