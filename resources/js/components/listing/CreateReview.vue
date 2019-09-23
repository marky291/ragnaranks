<template>

</template>

<script>
    import { Form, HasError, AlertError } from 'vform';
    import {Validator} from 'simple-vue-validator';

    export default {
        props: ['model'],
        components: {
            'has-error': HasError,
            'alert-error': AlertError,
        },
        data: function() {
            return {
                review: new Form({
                    message: this.model.message,
                    donation_score: this.model.donation_score,
                    update_score: this.model.update_score,
                    class_score: this.model.class_score,
                    item_score: this.model.item_score,
                    support_score: this.model.support_score,
                    hosting_score: this.model.hosting_score,
                    content_score: this.model.content_score,
                    event_score: this.model.event_score,
                })
            }
        },
        computed: {
            messageCharactersRemaining() {
                return 200 - this.review.message.length;
            }
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
            postReview: function (route) {
                this.$validate().then(success => {
                    if (success) {
                        this.review.post(route).then((response) => {
                            window.location.assign(response.data.route);
                        }).catch((errors) => {
                            this.$Message.error('Unable to process review, please try again.');
                        });
                    }
                });
            },
        },
        validators: {
            'review.message': function(value) {
                return Validator.value(value).required("You must enter a message to submit your review").minLength(200);
            },
            'review.donation_score': function(value) {
                return Validator.value(value).between(0,5, "Donation score must be between 0-5");
            },
            'review.update_score': function(value) {
                return Validator.value(value).between(0,5, "Update score must be between 0-5");
            },
            'review.class_score': function(value) {
                return Validator.value(value).between(0,5, "Class score must be between 0-5");
            },
            'review.item_score': function(value) {
                return Validator.value(value).between(0,5, "Item score must be between 0-5");
            },
            'review.support_score': function(value) {
                return Validator.value(value).between(0,5, "Support score must be between 0-5");
            },
            'review.hosting_score': function(value) {
                return Validator.value(value).between(0,5, "Hosting score must be between 0-5");
            },
            'review.content_score': function(value) {
                return Validator.value(value).between(0,5, "Content score must be between 0-5");
            },
            'review.event_score': function(value) {
                return Validator.value(value).between(0,5, "Event score must be between 0-5");
            }

        }
    }
</script>
