<script>
		import moment from 'moment';
    import { Form, HasError, AlertError } from 'vform';

    export default {
        props: ['review'],
        components: {
            'has-error': HasError,
            'alert-error': AlertError,
        },
        data() {
            return {
                starCount: 0,
                viewingDetails: false,
                commenting: false,

                comment: new Form({
                    message: '',
                })
            }
        },
				computed: {
            commentButtonText: function() {
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
							this.comment.post('/review/'+this.review.id+'/comment').then(response => {
							    this.$Message.success('Great! We have notified this user of your comment');
							    this.review.comments.push(response.data.comment);
							    this.commenting = false;
							}).catch(error => {
                  this.$Message.error(error.message);
							})
						},
						reportReview() {

						}
        }
    }

</script>