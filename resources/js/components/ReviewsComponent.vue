<template>

    <div class="">
<!--        <div v-for="(review, index) in collection">-->
<!--            <review :data="review"></review>-->
<!--        </div>-->

        <new-review @review-created="addReview" v-if="reviewable"></new-review>

    </div>

</template>

<script>

    import Review from './ReviewComponent.vue';
    import NewReview from '../components/NewReviewComponent.vue';

    export default {

        props: ['data', 'policy'],

        components: { Review, NewReview },

        data: function() {
            return {
                activated: false,
                collection: this.data,
                reviewable: true,
            }
        },

        created: function() {
            this.CalculateAverages()
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
            }
        }
    }

</script>