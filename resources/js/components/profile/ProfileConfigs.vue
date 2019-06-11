<script>
    import Multiselect from 'vue-multiselect';
    import {Validator} from 'simple-vue-validator';

    export default {
        props: ['defaultDescription'],
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
                tags: [
                    { name: 'all' },
                    { name: 'freebies' },
                    { name: 'gepard' },
                    { name: 'guild-pack' },
                    { name: 'pk-mode' },
                    { name: 'mobile' },
                    { name: 'frost' },
                    { name: 'no-donations' },
                    { name: 'instant-level' },
                    { name: 'themed-server' },
                ],
                languages: [
                    { name: 'english' },
                    { name: 'french' },
                    { name: 'german' },
                    { name: 'irish' },
                    { name: 'portuguese' },
                    { name: 'malaysian' },
                    { name: 'mandarin' },
                    { name: 'russian' },
                    { name: 'spanish' },
                    { name: 'tagalog' },
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
            }
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
        },
        validators: {
            screenshot: function (value) {
                return Validator.value(value).url();
            },
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
