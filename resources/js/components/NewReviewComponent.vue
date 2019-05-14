<template>
    <div @click="changeReviewState()" id="comment-reply" class="tw-mt-4 create-reply tw-flex tw-items-center rounded tw-cursor-pointer tw-border tw-border-dashed hover:tw-border-blue focus:tw-border-blue">
        <div class="tw-p-4 tw-flex tw-w-full tw-items-center">
<!--            <div class="tw-rounded-full tw-h-16 tw-w-16 tw-flex avatar-circle tw-items-center tw-justify-center tw-mr-6 tw-bg-grey">-->
<!--                <img class="tw-rounded-full avatar-circle" src="//www.gravatar.com/avatar/c2d52abc9f91d455e15a48d59fecd746?s=100&amp;d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fdefault-square-avatar.jpg" alt="">-->
<!--            </div>-->
            <span v-if="isCreatingReview" id="reply-action" class="tw-w-full">
                <p class="tw-text-grey-darker">You are creating a <span class="tw-text-blue">Review</span></p>
                 <textarea ref="input" class="tw-w-full tw-my-4 focus:tw-outline-none" name="comment" id="comment" cols="30" rows="7" placeholder="Write something nice..."></textarea>
                 <button id="submit-comment" class="tw-text-left tw-text-xs tw-bg-blue-light tw-w-full hover:tw-bg-blue-dark tw-text-white tw-font-bold tw-py-2 tw-px-4 tw-rounded-r tw-rounded-l">
                    Commit my reply
                 </button>
            </span>
            <p v-else id="reply-brief" class="text-grey-darkest font-weight-bold">Write my own review of this server</p>
        </div>
    </div>
</template>

<style>
    .invalid-feedback:empty {
        display: none !important;
    }
    .invalid-feedback {
        display: block !important;
    }
</style>
<script>

    class Errors {
        constructor() {
            this.errors = {};
        }
        get(field) {
            if (this.errors[field]) {
                return this.errors[field][0];
            }
        }
        record(errors) {
            this.errors = errors;
        }
        clear(field) {
            console.log(field);
            delete this.errors[field];
        }
        any() {
            return Object.keys(this.errors).length > 0;
        }
    }

    export default {

        data() {
            return {

                isCreatingReview: false,

                form: {
                    message: "",
                    donation_score: 5,
                    update_score: 5,
                    class_score: 5,
                    item_score: 5,
                    support_score: 5,
                    hosting_score: 5,
                    content_score: 5,
                    event_score: 5,
                },

                default: {
                    message: "",
                    donation_score: 5,
                    update_score: 5,
                    class_score: 5,
                    item_score: 5,
                    support_score: 5,
                    hosting_score: 5,
                    content_score: 5,
                    event_score: 5,
                },

                errors: new Errors(),

                endpoint: window.location.href + "/reviews",

                options: [
                    { text: '0', value: 0 },
                    { text: '1', value: 1 },
                    { text: '2', value: 2 },
                    { text: '3', value: 3 },
                    { text: '4', value: 4 },
                    { text: '5', value: 5 },
                    { text: '6', value: 6 },
                    { text: '7', value: 7 },
                    { text: '8', value: 8 },
                    { text: '9', value: 9 },
                    { text: '10', value: 10 },
                ],
            }
        },

        methods: {
            addReview() {
                axios.post(this.endpoint, this.form)
                    .then(response => {
                        this.$emit('review-created', this.form);
                        flash("Your review has been posted.");
                        this.form = this.default;
                    }).catch(error => this.errors.record(error.response.data.errors));
            },
            changeReviewState() {
                this.isCreatingReview = true;
                setTimeout(() => {
                    this.$refs.input.focus()
                })
            },
        }
    }

</script>