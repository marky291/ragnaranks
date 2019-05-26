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
										accent: '',
										configs: {},
                },
                dropzoneOptions: {
                    url: '/config/parse',
                    thumbnailWidth: 150,
                    maxFilesize: 0.5,
                    headers: { "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content }
                }
            }
        },
				mounted() {
					// show a random styling and background preset
					this.generatePreset();
				},
        methods: {
            generatePreset() {
                let preset = _.sample([
                    { accent: 'dark', background: '/img/preset/card-dark.png'},
										{ accent: 'purple', background: '/img/preset/card-purple.png'},
										{ accent: 'green', background: '/img/preset/card-green.png'},
										{ accent: 'blue', background: '/img/preset/card-blue.png'},
									]);
                this.listing.accent = preset.accent;
                this.listing.background = preset.background;
                this.updateListing();
						},
            addScreenshot() {
                this.listing.screenshots.push(this.screenshot);
            },
            updateListing() {
                this.$root.$emit('listing:profile:modified', {
                    data: this.listing,
                });
            },
            handleParsedConfig(file, response) {
                this.listing.configs[file.name.split(".")[0]] = response;
                this.$Message.success('The configuration inside ' + file.name + " has been added to your listing");
                this.updateListing();
						}
        }
	}
</script>