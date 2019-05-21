<template>

    <div v-bind:class="ScoreScale(score)" class="rating-block tw-shadow-md tw-tracking-tight tw-flex-1 p-2 d-flex align-items-center rounded overflow-hidden flex-column">
        <div class="d-flex flex-row">
            <div class="">
                <h4 class="tw-font-bold">{{ this.title }}</h4>
                <p class="mb-0">{{ this.description }}</p>
            </div>
        </div>
        <div class="w-100 h-100 align-items-end d-flex">
            <p class="tw-text-2xl text-right tw-font-bold">{{ score }} / 10</p>
        </div>
    </div>
</template>

<script>

    export default {

        props: ['title', 'description', 'score'],

        methods: {
            /**
             * @return {string}
             */
            ScoreScale: function(score) {
                if (score >= 10)
                    return "scale-1";
                if (score >= 9)
                    return "scale-2";
                if (score >= 8)
                    return "scale-3";
                if (score >= 6)
                    return "scale-4";
                if (score >= 4)
                    return "scale-5";
                if (score >= 2)
                    return "scale-6";
                if (score >= 0)
                    return "scale-7";
            },
        }
    }

</script>