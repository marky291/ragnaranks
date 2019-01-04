<template>

    <div class="">
        <div v-for="review in collection">
            <review :data="review"></review>
        </div>
    </div>

</template>

<script>

    import Review from './ReviewComponent.vue';

    export default {

        props: ['data'],

        components: { Review },

        data: function() {
            return {
                collection: this.data
            }
        },

        created: function() {
            this.CalculateAverages()
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
                return Math.round(number);
            }
        }
    }

</script>