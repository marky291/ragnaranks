<script>
    // import vue2Dropzone from 'vue2-dropzone';
    // import 'vue2-dropzone/dist/vue2Dropzone.min.css';
    import Multiselect from 'vue-multiselect';
    import {Validator} from 'simple-vue-validator';

    export default {
        props: ['tags', 'defaultDescription'],
        components: { Multiselect },
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
                featureChoices: [

                ],
                commandChoices: [
                    { name: '@accept', description: 'Accept a duel request from a player' },
                    { name: '@afk', description: 'placeholder' },
                    { name: '@allskill', description: 'placeholder' },
                    { name: '@alootid', description: 'placeholder' },
                    { name: '@autobuy', description: 'placeholder' },
                    { name: '@autoloot', description: 'placeholder' },
                    { name: '@autotrade', description: 'placeholder' },
                    { name: '@blvl', description: 'placeholder' },
                    { name: '@changegm', description: 'placeholder' },
                    { name: '@commands', description: 'placeholder' },
                    { name: '@duel', description: 'placeholder' },
                    { name: '@exp', description: 'placeholder' },
                    { name: '@feelreset', description: 'placeholder' },
                    { name: '@go', description: 'placeholder' },
                    { name: '@guildstorage', description: 'placeholder' },
                    { name: '@hominfo', description: 'placeholder' },
                    { name: '@invite', description: 'placeholder' },
                    { name: '@item', description: 'placeholder' },
                    { name: '@iteminfo', description: 'placeholder' },
                    { name: '@jailtime', description: 'placeholder' },
                    { name: '@jlvl', description: 'placeholder' },
                    { name: '@jump', description: 'placeholder' },
                    { name: '@leave', description: 'placeholder' },
                    { name: '@mobinfo', description: 'placeholder' },
                    { name: '@rates', description: 'placeholder' },
                    { name: '@refresh', description: 'placeholder' },
                    { name: '@request', description: 'placeholder' },
                    { name: '@showdelay', description: 'placeholder' },
                    { name: '@showexp', description: 'placeholder' },
                    { name: '@storage', description: 'placeholder' },
                    { name: '@time', description: 'placeholder' },
                    { name: '@warp', description: 'placeholder' },
                    { name: '@whereis', description: 'placeholder' },
                    { name: '@who', description: 'placeholder' },
                    { name: '@whobuy', description: 'placeholder' },
                    { name: '@whodrops', description: 'placeholder' },
                    { name: '@whogm', description: 'placeholder' },
                    { name: '@whosell', description: 'placeholder' },
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
            this.generatePreset();
        },
        methods: {
            addTag (newTag) {
                let tag = { name: newTag, description: 'Custom command' };
                this.$parent.listing.commands.push(tag);
                this.commandChoices.push(tag);
            },
            addScreenshot() {
                if (!_.isEmpty(this.screenshot)) {
                    this.$parent.listing.screenshots.push(this.screenshot);
                    this.screenshot = '';
                }
            },
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
            handleParsedConfig(file, response) {
                this.listing.configs[file.name.split(".")[0]] = response;
                this.$Message.success('The configuration inside ' + file.name + " has been added to your listing");
            }
        },
        validators: {
            screenshot: function (value) {
                return Validator.value(value).url();
            },
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
