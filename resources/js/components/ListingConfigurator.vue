<script>
    import vue2Dropzone from 'vue2-dropzone';
    import 'vue2-dropzone/dist/vue2Dropzone.min.css';
    import {Validator} from 'simple-vue-validator';

    export default {
        props: ['tags', 'defaultDescription'],
        components: {
            vueDropzone: vue2Dropzone
        },
        data: function () {
            return {
                screenshot: '',
                accents: [
                    'nightmare',
                    'poring',
                    'deviling',
                    'ghostring',
                    'drops',
                    'poporing',
                    'pouring',
                ],
                dropzoneOptions: {
                    url: '/config/parse',
                    thumbnailWidth: 150,
                    maxFilesize: 0.5,
                    headers: {"X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content}
                }
            }
        },
        mounted() {
            // show a random styling and background preset
            this.generatePreset();
        },
        methods: {
            removeScreenshot(index) {
                this.$parent.listing.screenshots.splice(index, 1);
            },
            generatePreset() {
                let preset = _.sample([
                    {accent: 'nightmare', background: '/img/preset/card-red.png'},
                    {accent: 'deviling', background: '/img/preset/card-purple.png'},
                    {accent: 'poporing', background: '/img/preset/card-green.png'},
                    {accent: 'pouring', background: '/img/preset/card-blue.png'},
                    {accent: 'ghostring', background: '/img/preset/card-aqua.png'},
                    {accent: 'nightmare', background: '/img/preset/card-black.png'},
                    {accent: 'drops', background: '/img/preset/card-mauve.png'},
                    {accent: 'poring', background: '/img/preset/card-pink.png'},
                ]);
                this.$parent.listing.accent = preset.accent;
                this.$parent.listing.background = preset.background;
            },
            addScreenshot() {
                if (!_.isEmpty(this.screenshot)) {
                    this.$parent.listing.screenshots.push(this.screenshot);
                    this.screenshot = '';
                }
            },
            handleParsedConfig(file, response) {
                this.listing.configs[file.name.split(".")[0]] = response;
                this.$Message.success('The configuration inside ' + file.name + " has been added to your listing");
            }
        },
        validators: {
            screenshot: function (value) {
                return Validator.value(value).url();
            }
        }
    }
</script>
