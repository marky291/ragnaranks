<script>
    import Scoreboards from '../components/ScoreboardsComponent.vue';
    import {Carousel3d, Slide} from 'vue-carousel-3d';
    import marked from 'marked'
    import axios from 'axios';

    export default {
        props: ['slug'],
        components: {
            Scoreboards,
            Carousel3d,
            Slide,
        },
        data: function () {
            return {
                preset: {
                    accent: '',
                    background: '',
                },
                listing: {
                    name: '',
                    tags: [],
                    language: 'english',
                    description: "# Welcome to RagnaRanks markdown editor!\n You can write something nice and descriptive with a huge amount of different formats!' [Guide](https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet)\n You can also use emojis copied from the web and paste them right here! 😍\n \n**Please utilize all the configuration options to allow us to maximize the potential of your listing(s)!**",
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
                        max_base_level: 0,
                        max_job_level: 0,
                        pk_mode: false,
                        episode: 0,
                        max_aspd: 0,
                        max_stats: 0,
                        base_exp_rate: 0,
                        job_exp_rate: 0,
                        quest_exp_rate: 0,
                        instant_cast: 0,
                        castrate_dex_scale: 0,
                        arrow_decrement: false,
                        undead_detect_type: false,
                        attribute_recover: false,
                    },
                    commands: [],
                },
            }
        },
        created: function() {
            console.log(this.slug);
        },
        async mounted() {
            axios.get('/api/listing/'+(this.slug)).then(response => {
                this.listing = response.data;
            });
        },
        computed: {
            background: function() {
                return _.isEmpty(this.listing.background) ? this.preset.background : this.listing.background;
            },
            accent: function() {
                return _.isEmpty(this.listing.accent) ? this.preset.accent : this.listing.accent;
            },
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
            commandChunks: function() {
                return _.chunk(this.listing.commands, this.listing.commands.length/2);
            }
        },
    }
</script>