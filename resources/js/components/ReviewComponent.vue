<script>
		import moment from 'moment';

    export default {
        props: ['review'],
        data() {
            return {
                starCount: 0,
                viewingDetails: false,
                commenting: false,
								commentMessage: '',
            }
        },
				computed: {
            reportButtonText: function() {
                return this.viewingDetails ? 'Close comment' : 'Comment as server owner';
						},
						detailButtonText: function() {
                return this.viewingDetails ? 'Less Detail' : 'View Details';
						},
						averageScore: function() {
                return (((this.review.donation_score + this.review.update_score + this.review.class_score + this.review.item_score + this.review.support_score + this.review.hosting_score + this.review.content_score + this.review.event_score) / 8) / 2).toFixed(1);
						},
						averageRating: function() {
                return this.$parent.ratingScore(4);
						}
				},
        methods: {
            toggleDetailedView() {
                this.detailedView = !this.detailedView;
            },
            memberSinceDate() {
                return moment(this.review.created_at).format('dddd, MMMM Do YYYY');
						},
						formattedDate()  {
						    return moment(this.review.created_at).startOf('day').fromNow();
						},
						postComment() {
							this.commenting = true;
						},
						reportReview() {

						}
        }
    }

</script>