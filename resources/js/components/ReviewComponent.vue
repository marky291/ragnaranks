<template>
    <div class="review">
        <div class="row">
            <div class="col bg-white pb-3 content">

                <div class="tw-flex mb-3 tw-items-center">
                    <div class="tw-rounded-full tw-h-16 tw-w-16 tw-flex tw-avatar-circle tw-items-center tw-justify-center tw-mr-3 tw-bg-grey">
                        <a href="/profile/update?username=Marky">
                            <img class="border hover:tw-border-solid hover:tw-border-grey hover:tw-shadow tw-rounded-full tw-avatar-circle" src="//www.gravatar.com/avatar/c2d52abc9f91d455e15a48d59fecd746?s=100&amp;d=https%3A%2F%2Fs3.amazonaws.com%2Flaracasts%2Fimages%2Fdefault-square-avatar.jpg" alt="">
                        </a>
                    </div>
                    <div class="tw-flex tw-flex-col tw-flex-1">
                        <div class="info d-flex align-items-center tw-flex mb-1">
                            <p class="h5 tw-flex-1 tw-text-grey-darkest tw-font-bold tw-mb-0">CabbageCrack</p>
                        </div>
                        <div class="tw-flex">
                            <at-rate
                                    :allow-half="true"
                                    :show-text="true"
                                    :value="getStarCount()"
                                    :disabled="true">
                            </at-rate>
                            <p class="tw-flex-1 tw-text-right tw-underline">Created 14th, June 2019</p>
                        </div>
                    </div>
                </div>
                <div class="description">
                    <p class="tw-text-grey-dark">{{ item.message }}</p>
                </div>
                <div v-show="detailedView" class="tw-flex tw-border-t tw-border-grey-light py-3 mt-3">
                    <ul class="tw-flex-1 mb-0">
                        <li class="tw-text-xs"><b>Donation Score</b>: {{ this.item.donation_score }}</li>
                        <li class="tw-text-xs"><b>Update Score</b>: {{ this.item.update_score }}</li>
                    </ul>
                    <ul class="tw-flex-1 mb-0">
                        <li class="tw-text-xs"><b>Classes Score</b>: {{ this.item.class_score }}</li>
                        <li class="tw-text-xs"><b>Items Score</b>: {{ this.item.item_score }}</li>
                    </ul>
                    <ul class="tw-flex-1 mb-0">
                        <li class="tw-text-xs"><b>Support Score</b>: {{ this.item.support_score }}</li>
                        <li class="tw-text-xs"><b>Hosting Score</b>: {{ this.item.hosting_score }}</li>
                    </ul>
                    <ul class="tw-flex-1 mb-0">
                        <li class="tw-text-xs"><b>Content Score</b>: {{ this.item.content_score }}</li>
                        <li class="tw-text-xs"><b>Events Score</b>: {{ this.item.event_score }}</li>
                    </ul>
                </div>
                <div class="tw-flex tw-justify-end">
                    <span v-if="!detailedView">
                        <at-button @click="toggleDetailedView()" icon="icon-maximize-2" type="text">Detailed</at-button>
                    </span>
                    <span v-else>
                        <at-button @click="toggleDetailedView()" icon="icon-minimize-2" type="text">Less Detail</at-button>
                    </span>
                    <at-button icon="icon-flag" type="text">Report</at-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['data'],
        data() {
            return {
                item: this.data,
                starCount: 0,
                detailedView: false,
            }
        },
        methods: {
            getStarCount: function() {
                return (((this.item.donation_score + this.item.update_score + this.item.class_score + this.item.item_score + this.item.support_score + this.item.hosting_score + this.item.content_score + this.item.event_score) / 8) / 2).toFixed(1);
            },
            toggleDetailedView() {
                this.detailedView = !this.detailedView;
            }
        }
    }

</script>