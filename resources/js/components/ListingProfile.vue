<script>
    import Scoreboards from '../components/ScoreboardsComponent.vue';
    import {Carousel3d, Slide} from 'vue-carousel-3d';
    import marked from 'marked'
    import Sticky from 'vue-sticky-directive';

    export default {
        directives: {Sticky},
        components: {
            Scoreboards,
            Carousel3d,
            Slide,
        },
        data: function () {
            return {
                listing: {
                    name: '',
                    tags: [],
                    language: 'english',
                    description: "# Welcome to RagnaRanks markdown editor!\n You can write something nice and descriptive with a huge amount of different formats!' [Guide](https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet)\n You can also use emojis copied from the web and paste them right here! 😍\n \n **Please utilize all the configuration options to allow us to maximize the potential of your listing(s)!**",
                    background: '',
                    screenshots: [],
                    accent: 'nightmare',
                    configs: {
                        item_drop_common: 0,
                        item_drop_equip: 0,
                        item_drop_card: 0,
                        item_drop_common_mvp: 0,
                        item_drop_equip_mvp: 0,
                        item_drop_card_mvp: 0,
                        item_drop_treasure: 0,
                        drops_by_luk: false,
                        max_base_level: 0,
                        max_job_level: 0,
                        max_aspd: 0,
                        max_stats: 0,
                        base_exp_rate: 0,
                        job_exp_rate: 0,
                        quest_exp_rate: 0,
                        cast_rate: 0,
                        delay_rate: 0,
                        castrate_dex_scale: 0,
                        vcast_stat_scale: 0,
                        arrow_decrement: false,
                        undead_detect_type: false,
                        attribute_recover: false,
                    },
                },
            }
        },
        computed: {
            markedDescription: function() {
                return marked(this.listing.description, {sanitize: true});
            },
            screenshots: function() {
                return _.isEmpty(this.listing.screenshots) ? ['/img/preset/slider_one.png', '/img/preset/slider_two.png', '/img/preset/slider_three.png'] : this.listing.screenshots;
            },
            serverName: function () {
                return _.isEmpty(this.listing.name) ? 'Default RO' : this.listing.name;
            },
            serverTags: function () {
                return _.isEmpty(this.listing.tags) ? 'RelatableRagnarokTags' : this.listing.tags;
            },
        },
    }
</script>