<script>
    import marked from 'marked'

    export default {
        props: ['slug'],
        data: function () {
            return {
                listing: { },
                preset: {},
                profileLoaded: false,
            }
        },
        mounted() {
            this.preset = _.sample([
                {accent: 'nightmare', background: '/img/preset/card-red.png'},
                {accent: 'deviling', background: '/img/preset/card-purple.png'},
                {accent: 'poporing', background: '/img/preset/card-green.png'},
                {accent: 'pouring', background: '/img/preset/card-blue.png'},
                {accent: 'ghostring', background: '/img/preset/card-aqua.png'},
                {accent: 'nightmare', background: '/img/preset/card-black.png'},
                {accent: 'drops', background: '/img/preset/card-mauve.png'},
                {accent: 'poring', background: '/img/preset/card-pink.png'},
            ]);

            axios.get('/api/listing/'+(this.slug)).then(response => {
                this.listing = response.data;
                this.profileLoaded = true;
            });
        },
        computed: {
            accent() {
                return this.listing.accent ? this.listing.accent : this.preset.accent;
            },
            background() {
                return this.listing.background ? this.listing.background : this.preset.background;
            },
            name: function () {
                return this.listing.name ? this.listing.name : 'Default RO';
            },
            description: function() {
                return marked(this.listing.description, {sanitize: true});
            },
            screenshots: function() {
                return this.listing.screenshots ? this.listing.screenshots : ['/img/preset/slider_one.png', '/img/preset/slider_two.png', '/img/preset/slider_three.png'];
            },
        }
    }
</script>