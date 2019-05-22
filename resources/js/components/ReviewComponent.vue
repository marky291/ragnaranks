<script>
		import moment from 'moment';

    export default {
        props: ['review'],
        data() {
            return {
                starCount: 0,
                detailedView: false,
            }
        },
        methods: {
            getStarCount: function() {
                return (((this.review.donation_score + this.review.update_score + this.review.class_score + this.review.item_score + this.review.support_score + this.review.hosting_score + this.review.content_score + this.review.event_score) / 8) / 2).toFixed(1);
            },
            toggleDetailedView() {
                this.detailedView = !this.detailedView;
            },
						formattedDate()  {
						    return moment(this.review.created_at).startOf('day').fromNow();
						}
        }
    }

</script>