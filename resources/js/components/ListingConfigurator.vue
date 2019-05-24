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
								uploadedConfigs: {},
                listing: {
                    name: '',
                    tags: [],
                    language: '',
                    description: '',
                    background: '',
                    screenshots: [],
										configs: [
										],
                },
                dropzoneOptions: {
                    url: '/config/parse',
                    thumbnailWidth: 150,
                    maxFilesize: 0.5,
                    headers: { "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content }
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
            },
            handleParsedConfig(file, response) {
                console.log(file, response);
                this.uploadedConfigs[file.name] = response;
                this.$Message.success('The configuration inside ' + file.name + " has been added to your listing");
						}
        }
	}
</script>