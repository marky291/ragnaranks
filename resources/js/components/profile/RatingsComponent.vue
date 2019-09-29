<template>

</template>
<script>
    import meanBy from 'lodash/meanBy';
    import Scoreboard from '../ScoreboardComponent';
    export default {
        props: ['reviews'],
        components: { Scoreboard },
        computed: {
            avg_donation_score(){ return this.average('donation_score'); },
            avg_update_score()  { return this.average('update_score');   },
            avg_class_score()   { return this.average('class_score');    },
            avg_item_score()    { return this.average('item_score');     },
            avg_support_score() { return this.average('support_score');  },
            avg_hosting_score() { return this.average('hosting_score');  },
            avg_content_score() { return this.average('content_score');  },
            avg_event_score()   { return this.average('event_score');    },
        },
        methods: {
            average(element) {
                if (this.reviews && this.reviews.length > 0) {
                    return Math.round(meanBy(this.reviews, function(item) {
                        return item[element];
                    }));
                }
            },
        }
    }
</script>
