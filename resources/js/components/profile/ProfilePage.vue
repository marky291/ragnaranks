<script>
    import marked from 'marked';
    import sample from 'lodash/sample';

    export default {
        props: ['slug'],
        data: function () {
            return {
                listing: {
                    isEditor: Boolean
                },
                configurations: {},
                profileLoaded: false,
                configLoaded: false,
                currentPage: 'profile',
            }
        },
        async mounted() {
            await axios.get('/api/listing/'+(this.slug)).then((response) => {
                this.listing = response.data;
                this.profileLoaded = true;
            });

            if (this.slug === 'defaults' || this.listing.isEditor === true) {
                await axios.get('/api/listing/configurations').then((response) => {
                    this.configurations = response.data;
                    this.configLoaded = true;
                });
            }
        },
        computed: {
            accent() {
                return this.listing.accent ? this.listing.accent : this.preset.accent;
            },
            background() {
                return this.listing.background ? this.listing.background : this.preset.card;
            },
            name: function () {
                return this.listing.name ? this.listing.name : 'Default RO';
            },
            description: function() {
                return marked(this.listing.description, {sanitize: true});
            },
            screenshots: function() {
                return this.listing.screenshots.length ? this.listing.screenshots : ['/img/preset/slider_one.png', '/img/preset/slider_two.png', '/img/preset/slider_three.png'];
            },
        },
        methods: {
            isCurrentPage(page) {
                return this.currentPage === page;
            },
            setCurrentPage(page) {
                this.currentPage = page;
            }
        }
    }
</script>