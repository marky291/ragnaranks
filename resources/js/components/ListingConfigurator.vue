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
                commandChoices: [
                    { name: '@accept' },
                    { name: '@afk' },
                    { name: '@allskill' },
                    { name: '@alootid' },
                    { name: '@autobuy' },
                    { name: '@autoloot' },
                    { name: '@autotrade' },
                    { name: '@blvl' },
                    { name: '@changegm' },
                    { name: '@commands' },
                    { name: '@duel' },
                    { name: '@exp' },
                    { name: '@feelreset' },
                    { name: '@go' },
                    { name: '@guildstorage' },
                    { name: '@hominfo' },
                    { name: '@invite' },
                    { name: '@item' },
                    { name: '@iteminfo' },
                    { name: '@jailtime' },
                    { name: '@jlvl' },
                    { name: '@jump' },
                    { name: '@leave' },
                    { name: '@mobinfo' },
                    { name: '@rates' },
                    { name: '@refresh' },
                    { name: '@request' },
                    { name: '@showdelay' },
                    { name: '@showexp' },
                    { name: '@storage' },
                    { name: '@time' },
                    { name: '@warp' },
                    { name: '@whereis' },
                    { name: '@who' },
                    { name: '@whobuy' },
                    { name: '@whodrops' },
                    { name: '@whogm' },
                    { name: '@whosell' },
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
                let tag = { name: newTag };
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
