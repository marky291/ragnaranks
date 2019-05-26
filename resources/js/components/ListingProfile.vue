<script>
    import Scoreboards from '../components/ScoreboardsComponent.vue';
    import { Carousel3d, Slide } from 'vue-carousel-3d';
    import marked from 'marked'

    export default {
        props: ['defaultDescription'],
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
            serverName: function() {
                return _.isEmpty(this.listing.name) ? 'Default RO' : this.listing.name;
						},
						serverTags: function() {
              	return _.isEmpty(this.listing.tags) ? 'RelatableRagnarokTags' : this.listing.tags;
						},
            compiledMarkdown: function () {
                return _.isEmpty(this.listing.description ? this.defaultDescription : marked(this.listing.description, {sanitize: true}))
            }
        },
        methods: {
            getDrop: function(element) {
                if (_.isObject(this.listing.configs.drops)) {
                    return this.listing.configs.drops[element];
                }
                return 0;
            },
        },
        created() {
            this.$root.$on('listing:profile:modified', event => {
                this.listing = event.data;
            })
        },
    }
</script>