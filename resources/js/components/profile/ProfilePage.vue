<script>
    import marked from 'marked';

    export default {
        props: ['slug', 'action', 'auth'],
        data: function () {
            return {
                listing: {
                    isEditor: Boolean,
                    canReview: Boolean,
                },
                buttons: {
                    reviewButton: {
                        text: '',
                        description: '',
                        disabled : true,
                    },
                },
                configurations: {},
                profileLoaded: false,
                configLoaded: false,
                currentPage: 'profile',
                availablePages: [
                    'profile',
                    'voting',
                ]
            }
        },
        async mounted() {
            await axios.get('/api/listing/'+(this.slug)).then((response) => {
                this.listing = response.data;
                this.profileLoaded = true;
                if (this.action) {
                    this.currentPage = this.isPageAccessible(this.action) ? this.action : 'profile';
                }
            });

            if (this.isCreating() || this.listing.isEditor === true) {
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
                return this.listing.screenshots.length ? this.listing.screenshots : ['preset/slider_one.png', 'preset/slider_two.png', 'preset/slider_three.png'];
            },
        },
        methods: {
            pushNewReview(review) {
                this.listing.reviews.push(review);
                this.buttons.reviewButton.text = "Listing already reviewed";
                this.buttons.reviewButton.disabled = true;
                this.setCurrentPage('profile');
            },
            isPageOwner() {
                return this.auth == this.listing.user_id
            },
            isPageAccessible(action) {
              return this.availablePages.indexOf(action)
            },
            isCreating() {
                return this.slug === 'defaults';
            },
            incrementVote(count) {
                this.listing.ranking.votes++;
                ga('send', 'event', 'Listing', 'voted', this.listing.name);
            },
            isCurrentPage(page) {
                return this.currentPage === page;
            },
            setCurrentPage(page) {
                this.currentPage = page;
                history.pushState({}, 'null', `?action=${page}`);
            },
            trackUserClick() {
                axios.post('/listing/' + this.listing.slug + '/clicks').then(response => {
                    ga('send', 'event', 'Listing', 'clicked', this.listing.name);
                });
            },
            goBack() {
                return window.history.back();
            },
        }
    }
</script>
