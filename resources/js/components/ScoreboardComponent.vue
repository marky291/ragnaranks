<template>
    <div v-bind:class="ScoreScale(score)" class="rating-block tw-shadow-md tw-tracking-tight tw-flex-1 p-2 d-flex align-items-center rounded overflow-hidden flex-column">
        <div class="d-flex flex-row">
            <div class="">
                <h4 class="tw-font-bold">{{ this.title }}</h4>
                <p class="mb-0">{{ this.description }}</p>
            </div>
        </div>
        <div class="w-100 h-100 align-items-end d-flex">
            <p class="tw-text-2xl text-right tw-font-bold">{{ computedScore }}</p>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['title', 'description', 'score'],
        computed: {
            computedScore() {
                return this.score ? (`${this.score}/5`) : this.$t('profile.scoreboards.score.default');
            },
        },
        methods: {
            /**
             * @return {string}
             */
            ScoreScale: function(score) {
                if (score >= 5) {
                    return "scoreboard-high";
                }
                if (score >= 3) {
                    return "scoreboard-mid";
                }
                return "scoreboard-low";
            }
        }
    }

</script>
