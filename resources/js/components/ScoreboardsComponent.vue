<script>

    import Scoreboard from './ScoreboardComponent';

    export default {

        components: { Scoreboard },

        data() {
            return {
                avg_donation_score: 5,
                avg_update_score: 5,
                avg_class_score: 5,
                avg_item_score: 5,
                avg_support_score: 5,
                avg_hosting_score: 5,
                avg_content_score: 5,
                avg_event_score: 5,
            }
        },

        created: function() {
            Event.$on('update:avg-donation-score', score => this.avg_donation_score = score);
            Event.$on('update:avg-update-score', score => this.avg_update_score = score);
            Event.$on('update:avg-class-score', score => this.avg_class_score = score);
            Event.$on('update:avg-item-score', score => this.avg_item_score = score);
            Event.$on('update:avg-support-score', score => this.avg_support_score = score);
            Event.$on('update:avg-hosting-score', score => this.avg_hosting_score = score);
            Event.$on('update:avg-content-score', score => this.avg_content_score = score);
            Event.$on('update:avg-event-score', score => this.avg_event_score = score);
        }
    }

</script>