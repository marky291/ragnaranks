<template>
    <section id="voting" class="content-block mt-4">
        <div class="container px-5 py-4">
            <h3 class="heading tw-font-bold mb-4 text-dark heading-underline">You are voting for {{ listingName }}</h3>
            <div class="row no-gutters">
                <p class="tw-font-bold mb-3 tw-text-green">{{ $t('profile.voting.available', {value: availableVotes}) }}</p>
                <p class="mb-3">{{ $t('profile.voting.notice', {hours: stats.spread}) }}</p>
                <at-button type="primary" icon="icon-log-out" class="mt-2">Vote for {{ listingName }}</at-button>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['listingName'],
        data: function() {
            return {
                stats: {
                    total: Number,
                    spread: Number,
                    value: Number,
                    concluded: Number,
                },
            }
        },
        computed: {
            availableVotes() {
                return this.stats.total - this.stats.concluded;
            }
        },
        mounted() {
            axios.get('/api/voting/stats').then((response) => {
                this.stats = response.data;
            }).catch((error) => {
                console.log(error.message);
            })
        }
    }
</script>