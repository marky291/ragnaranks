<template>
    <div class="review tw-mb-4">
        <div class="row no-gutters">
            <div class="col content tw-rounded tw-shadow-md">
                <div class="tw-flex tw-items-center tw-rounded-t" :class="'bg-'+$parent.$parent.$parent.accent+'-dark'">
                    <div class="tw-flex tw-flex-row tw-flex-1 tw-text-left">
                        <div class="info d-flex tw-flex-1 tw-flex-row tw-flex mb-1 tw-p-3">
                            <div class="tw-rounded-full tw-h-10 tw-w-10 tw-flex tw-avatar-circle tw-items-center tw-justify-center tw-mr-3 tw-bg-white">
                                <img class="border hover:tw-border-solid hover:tw-border-grey hover:tw-shadow tw-rounded-full tw-avatar-circle tw-h-10 tw-w-10" :src="review.user.avatar" alt="">
                            </div>
                            <div class="tw-flex tw-flex-col">
                                <p class="tw-flex-1 tw-font-semibold tw-mb-0 tw-text-white" style="font-size:.9rem">{{ review.user.username }}</p>
                                <p class="tw-text-white"><small>Posted {{ formattedDate() }}</small></p>
                            </div>
                        </div>
                        <div class="tw-flex tw-flex-col tw-self-center tw-rounded-l tw-text-right tw-p-3 tw-bg-white" :class="'bg-'+$parent.$parent.$parent.accent+'-base'">
                            <at-rate :show-text="true" v-model="review.average_score" :count="review.average_score" disabled>
                                <span class="tw-text-white tw-font-bold">{{this.ratingScore(review.average_score)}}</span>
                            </at-rate>
                        </div>
                    </div>
                </div>
                <div class="description tw-p-6">
                    <p class="tw-text-grey-darker">{{ review.message }}</p>
                </div>
                <div class="tw-border-red tw-px-6 tw-py-2 tw-rounded" v-for="comment in review.comments">
                    <p class="tw-font-semibold"><i class="fas fa-reply-all"></i> Response from server owner</p>
                    <p class="">{{ comment.message }}</p>
                </div>
                <div v-show="viewingDetails" class="tw-p-6 tw-border-t tw-border-grey-light">
                    <p class="tw-font-bold tw-mb-2 tw-underline">Detailed Review Score</p>
                    <div class="tw-flex tw-flex-row">
                        <ul class="tw-flex-1 tw-mb-0">
                            <li class="tw-text-xs"><b>Donation Score</b>: {{ review.donation_score }} ({{this.ratingScore(review.donation_score)}})</li>
                            <li class="tw-text-xs"><b>Update Score</b>: {{ review.update_score }} ({{this.ratingScore(review.update_score)}})</li>
                            <li class="tw-text-xs"><b>Classes Score</b>: {{ review.class_score }} ({{this.ratingScore(review.class_score)}})</li>
                            <li class="tw-text-xs"><b>Items Score</b>: {{ review.item_score }} ({{this.ratingScore(review.item_score)}})</li>
                        </ul>
                        <ul class="tw-flex-1 tw-mb-0">
                            <li class="tw-text-xs"><b>Support Score</b>: {{ review.support_score }} ({{this.ratingScore(review.support_score)}})</li>
                            <li class="tw-text-xs"><b>Hosting Score</b>: {{ review.hosting_score }} ({{this.ratingScore(review.hosting_score)}})</li>
                            <li class="tw-text-xs"><b>Content Score</b>: {{ review.content_score }} ({{this.ratingScore(review.content_score)}})</li>
                            <li class="tw-text-xs"><b>Events Score</b>: {{ review.event_score }} ({{this.ratingScore(review.event_score)}})</li>

                        </ul>
                    </div>
                </div>
                <div v-show="commenting" class="tw-p-6 tw-border-t tw-border-grey-light">
                    <p class="tw-text-red tw-font-semibold">Comment on this review as server owner</p>
                    <at-textarea v-model="comment.message" min-rows="5" class="tw-mt-2" autosize placeholder="Write your reply towards this review" :class="validation.hasError('comment.message') ? 'invalid-textarea' : ''"></at-textarea>
                    <div v-if="validation.hasError('comment.message')" class="tw-flex-1 tw-text-right help-block invalid-feedback">{{ validation.firstError('comment.message') }}</div>
                    <at-button @click="postComment" type="error" class="tw-mt-2">Post Comment</at-button>
                </div>
                <div class="tw-border-t tw-border-grey-light tw-py-2" :class="'bg-'+$parent.$parent.$parent.accent+'-lighter'">
                    <div class="tw-flex tw-justify-end">
                        <at-button @click="viewingDetails = !viewingDetails" icon="icon-maximize-2" type="text">{{ detailButtonText }}</at-button>
                        <at-button @click="reportReview" icon="icon-flag" type="text">Report</at-button>
                        <at-button v-if="$parent.$parent.$parent.isPageOwner() && review.comments.length === 0" @click="commenting = !commenting" icon="icon-paperclip" type="text">{{ commentButtonText }}</at-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
		import moment from 'moment';
    import { Form, HasError, AlertError } from 'vform';
    import {Validator} from 'simple-vue-validator';

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
				},
        methods: {
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
							    if(response.data.success === true) {
                      this.$Message.success('Your reply has been added, we will notify the creator.');
                      this.review.comments.push(response.data.comment);
                      this.commenting = false;
                  } else {
							        this.$Message.error(response.data.message);
                  }
							}).catch(error => {
                  this.$Message.error(error.message);
							})
						},
            reportReview: function() {
                this.$Modal.prompt({
                    title: 'Report Content',
                    content: 'Type your reason for reporting this review:'
                }).then((data) => {
                    this.report.reason = data.value;
                    this.report.post('/review/'+this.review.id+'/report').then(response => {
                        this.$Message.success('Thanks, We will notify you when we decide action upon the review.');
                    }).catch(error => {
                        this.$Message.error("Oops, Something went wrong.");
                    })
                });
            },
        },
        validators: {
            'comment.message': function(value) {
                return Validator.value(value).required().minLength(50).maxLength(550);
            },
        }
    }

</script>