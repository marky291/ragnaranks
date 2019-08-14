<template>
    <section id="ratings">
        <div class="tw-px-10">
            <div class="py-3 mb-3 rounded" style="border:1px solid rgba(255, 255, 255, 0.2);">
                <h3 class="heading mb-4 tw-font-bold heading-underline tw-tracking-tighter">Balance Ratings</h3>
                <div class="row no-gutters">
                    <div class="d-flex">
                        <scoreboard title="Donations" description="Non-Donators can compete with Donators." :score="avg_donation_score"></scoreboard>
                        <scoreboard title="Updates" description="Improvements made each update." :score="avg_update_score"></scoreboard>
                        <scoreboard title="Classes" description="Classes are balanced against other classes." :score="avg_class_score"></scoreboard>
                        <scoreboard title="Items" description="Item stats are fair and well thought out." :score="avg_item_score"></scoreboard>
                    </div>
                </div>
            </div>
            <div class="py-3 mb-3 rounded" style="border:1px solid rgba(255, 255, 255, 0.2)">
                <h3 class="heading mb-4 tw-font-bold heading-underline tw-tracking-tighter">Server Ratings</h3>
                <div class="row no-gutters">
                    <div class="d-flex">
                        <scoreboard title="Support" description="Non-Donators can compete with Donators." :score="avg_support_score"></scoreboard>
                        <scoreboard title="Hosting" description="The availability and ping is playable and fun." :score="avg_hosting_score"></scoreboard>
                        <scoreboard title="Content" description="There is much to do and progress upon." :score="avg_content_score"></scoreboard>
                        <scoreboard title="Events" description="Rewards are good and events are regular." :score="avg_event_score"></scoreboard>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
