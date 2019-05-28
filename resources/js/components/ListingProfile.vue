<script>
    import Scoreboards from '../components/ScoreboardsComponent.vue';
    import {Carousel3d, Slide} from 'vue-carousel-3d';
    import marked from 'marked'

    export default {
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
                    language: '',
                    description: '',
                    background: '',
                    screenshots: [],
                    accent: '',
                    configs: {},
                },
            }
        },
        computed: {
            screenshots: function() {
                return _.isEmpty(this.listing.screenshots) ? ['/img/preset/slider_one.png', '/img/preset/slider_two.png', '/img/preset/slider_three.png'] : this.listing.screenshots;
            },
            serverName: function () {
                return _.isEmpty(this.listing.name) ? 'Default RO' : this.listing.name;
            },
            serverTags: function () {
                return _.isEmpty(this.listing.tags) ? 'RelatableRagnarokTags' : this.listing.tags;
            },
            compiledMarkdown: function () {
                return marked(this.listing.description, {sanitize: true});
            }
        },
        methods: {
            getConfig: function (file, element) {
                if (_.isObject(this.listing.configs[file])) {
                    return this.listing.configs[file][element];
                }
                return 0;
            },
        },
        created() {
            this.$root.$on('listing:profile:modified', event => {
                this.listing = event.data;
            });
        },
    }
</script>