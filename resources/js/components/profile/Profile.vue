<script>
    import Scoreboards from '../ScoreboardsComponent.vue';
    import {Carousel3d, Slide} from 'vue-carousel-3d';

    export default {
        props: ['slug'],
        components: {
            Scoreboards,
            Carousel3d,
            Slide,
        },
        data: function () {
            return {
                listing: {
                    name: '',
                    description: "# Welcome to RagnaRanks markdown editor!\n You can write something nice and descriptive with a huge amount of different formats!' [Guide](https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet)\n You can also use emojis copied from the web and paste them right here! 😍\n \n**Please utilize all the configuration options to allow us to maximize the potential of your listing(s)!**",
                    tags: [],
                    language: 'english',
                    screenshots: [],
                    configs: {},
                    commands: [],
                },
            }
        },
        computed: {
            commandChunks: function() {
                return _.chunk(this.listing.commands, this.listing.commands.length/2);
            }
        },
    }
</script>