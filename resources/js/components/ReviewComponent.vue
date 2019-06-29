<template>
    <div class="review tw-mb-4 tw-p-3">
        <div class="row no-gutters">
            <div class="col bg-white pb-3 content">
                <div class="tw-flex mb-3 tw-items-center">
                    <div class="tw-rounded-full tw-h-16 tw-w-16 tw-flex tw-avatar-circle tw-items-center tw-justify-center tw-mr-3 tw-bg-grey">
                        <img class="border hover:tw-border-solid hover:tw-border-grey hover:tw-shadow tw-rounded-full tw-avatar-circle" :src="review.publisher.avatarUrl" alt="">
                    </div>
                    <div class="tw-flex tw-flex-row tw-flex-1 tw-text-left">
                        <div class="info d-flex tw-flex-col tw-flex mb-1">
                            <p class="tw-flex-1 tw-text-lg tw-text-grey-darkest tw-font-semibold tw-mb-0">@{{ review.publisher.username }}</p>
                            <p>Member since @{{ memberSinceDate() }}</p>
                        </div>
                        <div class="tw-flex tw-flex-col tw-text-right tw-flex-1">
                            Rating: @{{ averageRating }} (@{{ averageScore }})
                            <p class="tw-flex-1">Posted @{{ formattedDate() }}</p>
                        </div>
                    </div>
                </div>
                <div class="description">
                    <p class="tw-text-grey-dark">@{{ review.message }}</p>
                </div>
                <div class="tw-border-red tw-p-2 tw-mt-2 tw-bg-red-lightest tw-rounded" v-for="(comment, index) in review.comments">
                    <p class="tw-font-semibold">Reply from owner</p>
                    <p class="tw-text-red">@{{ comment.message }}</p>
                </div>
                <div v-show="viewingDetails" class="tw-flex tw-border-t tw-border-grey-light py-3 mt-3">
                    <ul class="tw-flex-1 mb-0">
                        <li class="tw-text-xs"><b>Donation Score</b>: @{{ review.donation_score }}</li>
                        <li class="tw-text-xs"><b>Update Score</b>: @{{ review.update_score }}</li>
                    </ul>
                    <ul class="tw-flex-1 mb-0">
                        <li class="tw-text-xs"><b>Classes Score</b>: @{{ review.class_score }}</li>
                        <li class="tw-text-xs"><b>Items Score</b>: @{{ review.item_score }}</li>
                    </ul>
                    <ul class="tw-flex-1 mb-0">
                        <li class="tw-text-xs"><b>Support Score</b>: @{{ review.support_score }}</li>
                        <li class="tw-text-xs"><b>Hosting Score</b>: @{{ review.hosting_score }}</li>
                    </ul>
                    <ul class="tw-flex-1 mb-0">
                        <li class="tw-text-xs"><b>Content Score</b>: @{{ review.content_score }}</li>
                        <li class="tw-text-xs"><b>Events Score</b>: @{{ review.event_score }}</li>
                    </ul>
                </div>
                <div v-show="commenting" class="tw-mt-3">
                    <p class="tw-text-red tw-font-semibold">Comment on this review as server owner</p>
                    <at-textarea v-model="comment.message" min-rows="5" class="tw-mt-2" autosize placeholder="Write your reply towards this review"></at-textarea>
                    <has-error :form="comment" field="message"></has-error>
                    <at-button @click="postComment" type="error" class="tw-mt-2">Post Comment</at-button>
                </div>
                <div class="tw-flex tw-justify-end">
                    <at-button @click="viewingDetails = !viewingDetails" icon="icon-maximize-2" type="text">@{{ detailButtonText }}</at-button>
                    <at-button @click="reportReview" icon="icon-flag" type="text">Report</at-button>
                    <at-button v-if="!review.comments.length" @click="commenting = !commenting" icon="icon-paperclip" type="text">@{{ commentButtonText }}</at-button>
                </div>
            </div>
        </div>
    </div>
</template>

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
                }),

                report: new Form({
                    reason: '',
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
            reportReview: function() {
                this.$Modal.prompt({
                    title: 'Reporting review created by {REVIEW_NAME}',
                    content: 'Type your reason for reporting this review:'
                }).then((data) => {
                    this.report.reason = data.value;
                    this.report.post('/review/'+this.review.id+'/report').then(response => {
                        this.$Message.success('Awesome!, We will notify you when we decide action upon the review.');
                    }).catch(error => {
                        this.$Message.error(error.message);
                    })
                });
            },
        }
    }

</script>