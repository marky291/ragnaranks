<script>

    import Reviews from '../components/ReviewsComponent.vue';

    export default {
        components: {
            Reviews,
        },
        props: {
            clicked: Boolean,
            voted: Boolean,
        },

        created: function() {
            this.$root.$on('creating:review', (param) => {
                this.creating_review = param; // when review is made hide shit.
            });
        },

        data() {
            return {
                currentView: 'listing',
                creating_review: false,
                validation: {
                    vote: this.voted,
                    click: this.clicked,
                }
            }
        },

        methods: {
            theCurrentViewIs: function (view) {
                return this.currentView === view;
            },
            CastVote: function(route) {
                this.validation.vote = true;
                axios.post(window.location.href + route).then(response => function() {
                    this.validation.vote = true;
                    flash('Your vote has been posted.')
                }).catch(response => function() {
                    console.log(response);
                    flash('Vote could not be processed right now sorry.')
                });
            },
            handler: function() {
                console.log('handles');
            },
            toggleReview: function() {
                this.$root.$emit('toggle:review');
            },
            setView: function(view) {
                return this.currentView = view;
            }
        }
    }

</script>