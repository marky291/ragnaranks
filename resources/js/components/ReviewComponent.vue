<template>
    <div class="review px-3 py-2">
        <div class="row">
            <div class="avatar mr-2">
                <span class="font-weight-bold">M</span>
            </div>
            <div class="col bg-white p-3 ml-3 content">
                <div class="info d-flex align-items-center">
                    <!--<span class="user mr-2" style="color: #ff194d;">{{ fake()->firstName . " " . fake()->lastName }}</span>-->
                    <small class="mr-2">‣</small>
                    <small>Posted 22 Hours ago</small>
                </div>
                <div class="description">
                    {{ item.message }}
                </div>
                <div class="scores d-flex flex-row">
                <div :class="ScoreScale(item.donation_score)" class="score">
                    Donation Balance : <span class="font-weight-bold">{{ item.donation_score }}</span>
                </div>
                <div :class="ScoreScale(item.update_score)" class="score">
                    Update Balance : <span class="font-weight-bold">{{ item.update_score }}</span>
                </div>
                <div :class="ScoreScale(item.class_score)" class="score">
                    Class Balance : <span class="font-weight-bold">{{ item.class_score }}</span>
                </div>
                <div :class="ScoreScale(item.item_score)" class="score">
                    Item Balance : <span class="font-weight-bold">{{ item.item_score}}</span>
                </div>
                <div :class="ScoreScale(item.support_score)" class="score">
                    Support : <span class="font-weight-bold">{{ item.support_score}}</span>
                </div>
                <div :class="ScoreScale(item.content_score)" class="score">
                    Content : <span class="font-weight-bold">{{ item.content_score}}</span>
                </div>
                    <div :class="ScoreScale(item.hosting_score)" class="score">
                    Hosting : <span class="font-weight-bold">{{ item.hosting_score }}</span>
                </div>
                <div :class="ScoreScale(item.event_score)" class="score">
                    Events : <span class="font-weight-bold">{{ item.event_score }}</span>
                </div>
            </div>
        </div>

            <div class="rating p-3 bg-white d-flex flex-column">
                <div class="stars d-flex align-self-center mb-2">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <i class="far fa-star"></i>
                </div>
                <span class="text-center">
                    {{ starCount }} out of 5
                </span>
                <div class="actions d-flex flex-fill align-items-end">
                    <button class="btn-sm btn-outline-primary" @click="destroy">Delete Review</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['data'],

        data() {
            return {
                item: this.data,
                starCount: 0
            }
        },

        created: function() {
            this.starCount = (((this.item.donation_score + this.item.update_score + this.item.class_score + this.item.item_score + this.item.support_score + this.item.hosting_score + this.item.content_score + this.item.event_score) / 8) / 2).toFixed(1);
        },

        methods: {
            ScoreScale: function(score) {
                if (score >= 7)
                    return "score-is-good";

                if (score >= 4)
                    return "score-is-ok";

                return "score-is-bad";
            },

            destroy: function() {
                $(this.$el).fadeOut(300, () =>
                {
                    flash("Review was deleted.");
                    this.$emit('review-deleted', this);
                });
            }
        }
    }

</script>