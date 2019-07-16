<template>
    <section id="voting" class="content-block mt-4">
        <div class="container px-5 py-4">
            <h3 class="heading tw-font-bold mb-4 text-dark heading-underline">You are voting for x</h3>
            <div class="row no-gutters">
                <p class="tw-font-bold mb-3 tw-text-green">You have (1) vote remaining!</p>
                <p class="mb-3">Your vote will have a cooling period of <b>6 hours</b>, this cannot be returned and will remain on x for 7 days starting from the time and date of your cast</p>
                <at-button type="primary" icon="icon-log-out" class="mt-2">Vote for x</at-button>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data: function() {
            return {
                //
            }
        }
    }
</script>