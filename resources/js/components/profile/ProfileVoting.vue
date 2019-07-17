<template>
    <section id="voting" class="content-block mt-4">
        <div class="container px-5 pb-4 pt-2">
            <h3 class="heading tw-font-bold mb-4 text-dark heading-underline">{{ messages.heading }}</h3>
            <div class="row no-gutters">
                <p class="tw-font-bold mb-3" :class="availableVotes > 0 ?'tw-text-green':'tw-text-red'">{{ $t('profile.voting.spending', {value: availableVotes}) }}</p>
                <p class="mb-3">{{ messages.content }}</p>

                <div v-if="availableVotes > 0">
                    <google-re-captcha-v3
                            ref="captcha" v-model="gRecaptchaResponse"
                            :siteKey="'6LdT_aMUAAAAANYwPoNyZ4eaFX2kqZHi4wZTySp9'"
                            :id="'vote_id'"
                            :inline="false"
                            :action="'vote'">
                    </google-re-captcha-v3>

                    <at-button @click="sendVote()" type="primary" class="mt-2 tw-h-10 tw-w-full">Vote for {{ listingName }}</at-button>
                </div>
            </div>
        </div>
    </section>
</template>

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
                axios.post('/listing/'+this.listingSlug+'/votes', {captchaV3:this.gRecaptchaResponse}).then((success) => {
                    this.$refs.captcha.execute();
                    this.stats.concluded++;
                    this.messages.heading = this.$t('profile.voting.heading.finished', {name:this.listingName});
                    this.messages.content = this.$t('profile.voting.finished', {name:this.listingName, hours:this.stats.spread});
                }).catch((error) => {
                    this.$refs.captcha.execute();
                })
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
                console.log(error.message);
            })
        },
    }
</script>