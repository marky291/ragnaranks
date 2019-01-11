<template>
    <div class="">
        <div class="form-group">
            <label for="message">Comment</label>
            <textarea class="form-control" id="message" rows="5" placeholder="Why not write about your experience?" v-model="message"></textarea>
        </div>

        <button type="submit" class="btn btn-default" @click="addReview">Submit</button>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                message: "",
                endpoint: "",
            }
        },

        methods: {
            addReview() {
                axios.post(this.endpoint, { message: this.message })
                    .then(response => {
                        this.message = "";
                        this.$emit('review-created', response.data);
                        flash("Your review has been posted.");
                    });
            }
        }
    }

</script>