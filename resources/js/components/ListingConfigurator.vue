<script>
	export default {
        props: ['tags'],
        data: function() {
            return {
                screenshot: '',
                listing: {
                    name: '',
                    tags: [],
                    language: '',
                    description: '',
                    background: '',
                    screenshots: [],
                }
            }
        },
        methods: {
            addScreenshot() {
                this.listing.screenshots.push(this.screenshot);
            },
            updateListing() {
                this.$root.$emit('listing:profile:modified', {
                    data: this.listing,
                });
            }
        }
	}
</script>