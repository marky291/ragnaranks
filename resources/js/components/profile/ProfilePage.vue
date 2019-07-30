<script>
    import marked from 'marked';
    import find from 'lodash/find'

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
                        text: 'Log in to create a review',
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
                this.currentPage = this.isPageAccessible(this.action) ? this.action : 'profile';
            });

            if (this.isPageOwner()) {
                this.buttons.reviewButton.text = "Cannot review own server";
                this.buttons.reviewButton.disabled = true;
            } else if (this.listing.canReview === false) {
                this.buttons.reviewButton.text = "Cannot Review Listing";
                this.buttons.reviewButton.disabled = true;
            } else if (this.auth !== false) {
                this.buttons.reviewButton.text = "Create a review";
                this.buttons.reviewButton.disabled = false;
                this.availablePages.push('reviewing');
            }

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
                return this.listing.screenshots.length ? this.listing.screenshots : ['/img/preset/slider_one.png', '/img/preset/slider_two.png', '/img/preset/slider_three.png'];
            },
        },
        methods: {
            pushNewReview(review) {
                this.listing.reviews.push(review);
                this.buttons.reviewButton.text = "Cannot Review Listing";
                this.buttons.reviewButton.disabled = true;
                this.setCurrentPage('profile');
            },
            isPageOwner() {
                return this.auth == this.listing.user_id
            },
            isPageAccessible(page) {
              return find(this.availablePages, page);
            },
            isCreating() {
                return this.slug === 'defaults';
            },
            incrementVote(count) {
                this.listing.ranking.votes++;
            },
            isCurrentPage(page) {
                return this.currentPage === page;
            },
            setCurrentPage(page) {
                this.currentPage = page;
                history.pushState({}, 'null', `?action=${page}`);
            },
            visitWebsite() {
                // track the click.
                axios.post('/listing/' + this.listing.slug + '/clicks').then((response) => {
                    if(response.data.success === true) {
                        this.listing.ranking.clicks++;
                    }
                });
                // visit the page.
                window.open(this.listing.website,'_blank');
            },
            goBack() {
                return window.history.back();
            },
        }
    }
</script>