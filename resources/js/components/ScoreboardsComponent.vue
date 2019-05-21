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
            this.$root.$on('update:scoreboard', (param) => {
                this.avg_donation_score = param.donation_score;
                this.avg_update_score = param.update_score;
                this.avg_class_score = param.class_score;
                this.avg_item_score = param.item_score;
                this.avg_support_score = param.support_score;
                this.avg_hosting_score = param.hosting_score;
                this.avg_content_score = param.content_score;
                this.avg_event_score = param.event_score;
            });
        }
    }

</script>