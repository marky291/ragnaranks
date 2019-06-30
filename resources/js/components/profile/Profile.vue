<script>
    import {Carousel3d, Slide} from 'vue-carousel-3d';
    import Reviews from '../ReviewsComponent.vue';
    import ReviewCreator from '../profile/ProfileReviewCreator.vue';
    import Scoreboards from '../ScoreboardsComponent.vue';

    export default {
        components: {
            Carousel3d,
            Slide,
            Reviews,
            ReviewCreator,
            Scoreboards,
        },
        data: function () {
            return {
                reviews: {}
            }
        },
        async mounted() {
            console.log('mounted');
            await axios.get('/api/listing/ragnarok-clashed-server').then((response) => {
                this.reviews = response.data;
            });
        },
        methods: {
            test() {
                console.log('test');
            }
        }
    }
</script>