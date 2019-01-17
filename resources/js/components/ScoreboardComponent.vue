<template>
    <div class="col mr-2 d-flex align-items-center rounded overflow-hidden" :class="ScoreScale(this.score)">
        <div class="rating-block d-flex flex-row py-3 h-100">
            <div class="d-flex align-items-center">
                <div class="w-75">
                    <h4 class="text-light">{{ this.title }}</h4>
                    <p class="text-light mb-0">{{ this.description }}</p>
                </div>
                <span class="score position-absolute text-transparent h-100 d-flex align-items-center">
                    {{ this.score }}
                </span>
            </div>
        </div>
    </div>
</template>

<script>

    export default {

        props: ['title', 'description', 'score'],

        methods: {
            ScoreScale: function(score) {
                if (score >= 7)
                    return "score-is-good";

                if (score >= 4)
                    return "score-is-ok";

                return "score-is-bad";
            }
        }
    }

</script>