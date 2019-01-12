<template>
    <div class="">
        <form @submit.prevent="addReview" @keydown="errors.clear($event.target.name)">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="donation_score">Donation Score</label>
                        <select class="form-control" name="donation_score" id="donation_score" v-model="form.donation_score">
                            <option v-for="option in options" v-bind:value="option.value">
                                {{ option.text }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="update_score">Update Score</label>
                        <select class="form-control" name="update_score" id="update_score" v-model="form.update_score">
                            <option v-for="option in options" v-bind:value="option.value">
                                {{ option.text }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="class_score">Class Score</label>
                        <select class="form-control" name="class_score" id="class_score" v-model="form.class_score">
                            <option v-for="option in options" v-bind:value="option.value">
                                {{ option.text }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="item_score">Item Score</label>
                        <select class="form-control" name="item_score" id="item_score" v-model="form.item_score">
                            <option v-for="option in options" v-bind:value="option.value">
                                {{ option.text }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="support_score">Support Score</label>
                        <select class="form-control" name="support_score" id="support_score" v-model="form.support_score">
                            <option v-for="option in options" v-bind:value="option.value">
                                {{ option.text }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="hosting_score">Hosting Score</label>
                        <select class="form-control" name="hosting_score" id="hosting_score"  v-model="form.hosting_score">
                            <option v-for="option in options" v-bind:value="option.value">
                                {{ option.text }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="content_score">Content Score</label>
                        <select class="form-control" name="content_score" id="content_score"  v-model="form.content_score">
                            <option v-for="option in options" v-bind:value="option.value">
                                {{ option.text }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="event_score">Event Score</label>
                        <select class="form-control" name="event_score" id="event_score"  v-model="form.event_score">
                            <option v-for="option in options" v-bind:value="option.value">
                                {{ option.text }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="message">Comment</label>
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Why not write about your experience?" v-model="form.message"></textarea>
                <div class="invalid-feedback" v-text="errors.get('message')"></div>
            </div>

            <button type="submit" class="btn btn-default" :disabled="errors.any()""">Submit</button>
        </form>
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
            }
        }
    }

</script>