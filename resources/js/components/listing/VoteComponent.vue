<script>
    import GoogleReCaptchaV3 from '../googlerecaptchav3/GoogleReCaptchaV3';

    export default {
        props: ['listingName', 'listingSlug'],
        components: {
            GoogleReCaptchaV3,
        },
        data: function() {
            return {
                stats: {
                    total: Number,
                    spread: Number,
                    value: Number,
                    concluded: Number,
                },
                messages: {
                    heading: "",
                    content: "",
                },
                gRecaptchaResponse: null,
            }
        },
        computed: {
            availableVotes() {
                return this.stats.total - this.stats.concluded;
            }
        },
        methods: {
            sendVote() {
                axios.post(`/listing/${this.listingSlug}/votes`, {captchaV3:this.gRecaptchaResponse}).then((success) => {
                    this.stats.concluded++;
                    this.$emit('vote:created');
                    this.messages.heading = this.$t('profile.voting.heading.finished', {name:this.listingName});
                    this.messages.content = this.$t('profile.voting.finished', {name:this.listingName, hours:this.stats.spread});
                    this.$Message.success('Awesome, your vote has been contributed towards ' + this.listingName + '!');
                }).catch((error) => {
                    this.$Message.error(error.message);
                });
                this.$refs.captcha.execute();
            }
        },
        mounted() {
            axios.get('/api/voting/stats').then((response) => {
                this.stats = response.data;
                if (this.availableVotes < 1) {
                    this.messages.heading = this.$t('profile.voting.heading.completed', {name: this.listingName});
                    this.messages.content = this.$t('profile.voting.completed', {hours:this.stats.spread});
                } else {
                    this.messages.heading = this.$t('profile.voting.heading.pending', {name: this.listingName});
                    this.messages.content = this.$t('profile.voting.pending', {hours:this.stats.spread});
                }

            }).catch((error) => {
                this.messages.heading = this.$t('profile.voting.heading.declined');
                this.messages.content = this.$t('profile.voting.declined');
            })
        },
    }
</script>
