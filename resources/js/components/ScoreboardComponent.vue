<template>

    <div class="col d-flex align-items-center rounded overflow-hidden d-flex flex-column">
        <div class="rating-block d-flex flex-row py-3 h-100">
            <div class="d-flex align-items-center">
                <div class="w-75">
                    <h4 class="text-dark">{{ this.title }}</h4>
                    <p class="text-dark mb-0">{{ this.description }}</p>
                </div>
                <span class="score position-absolute text-transparent h-100 d-flex align-items-center">
                    <i class="fas fa-medal" :class="ScoreScale(this.score)"></i>
                </span>
            </div>
        </div>
        <div class="w-100 bg-light py-1 px-2">
            <small><b>Score</b>: {{ score }} / 10</small>
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