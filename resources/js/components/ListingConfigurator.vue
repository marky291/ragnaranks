<script>
	import vue2Dropzone from 'vue2-dropzone'
	import 'vue2-dropzone/dist/vue2Dropzone.min.css'
	export default {
        props: ['tags'],
				components: {
						vueDropzone: vue2Dropzone
				},
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
                },
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