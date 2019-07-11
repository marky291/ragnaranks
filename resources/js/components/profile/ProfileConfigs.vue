<template>
    <div class="">
        <at-collapse accordion value="details" class="" style="overflow:visible">
            <at-collapse-item name="details">
                <div slot="title">Initial Card Setup</div>
                <div :class="'bg-'+current.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
                    <p class="tw-font-bold">Card Design</p>
                </div>
                <div class="tw-p-2">
                    <div class="tw-flex tw-flex-row tw-items-baseline">
                        <p class="tw-text-left tw-font-semibold tw-mb-1">Server Name</p>
                        <div v-if="validation.hasError('current.name')" class="tw-flex-1 tw-text-right help-block invalid-feedback">{{ validation.firstError('current.name') }}</div>
                    </div>
                    <at-input v-model="current.name" size="small" placeholder="Please input" :status="validation.hasError('current.name') ? 'error' : ''"></at-input>

                    <!--                    <has-error :form="listing" field="name"></has-error>-->
                </div>
                <div class="tw-p-2">
                    <p class="tw-font-semibold tw-mb-1">Accent Color</p>
                    <at-select v-model="current.accent" class="tw-capitalize">
                        <at-option v-for="(accent,i) in configurations.accents" :label="accent" :key="i" :value="accent" class="tw-items-center">{{ accent }}
                            <div class="tw-flex-1 tw-flex tw-flex-row">
                                <div class="tw-h-4 tw-w-2 tw-flex-1" :class="'bg-'+accent+'-lightest'"></div>
                                <div class="tw-h-4 tw-w-2 tw-flex-1" :class="'bg-'+accent+'-light'"></div>
                                <div class="tw-h-4 tw-w-2 tw-flex-1" :class="'bg-'+accent+'-base'"></div>
                                <div class="tw-h-4 tw-w-2 tw-flex-1" :class="'bg-'+accent+'-dark'"></div>
                                <div class="tw-h-4 tw-w-2 tw-flex-1" :class="'bg-'+accent+'-darkest'"></div>
                            </div>
                        </at-option>
                    </at-select>
<!--                    <has-error :form="listing" field="accent"></has-error>-->
                </div>
                <div class="tw-p-2">
                    <p class="tw-font-semibold tw-mb-1">Nationality</p>
                    <div class="tw-flex">
                        <at-select v-model="current.language" class="tw-capitalize">
                            <at-option v-for="(language, i) in configurations.languages" :key="i" :value="language" :label="language"><img class="tw-w-4 tw-h-4 tw-mr-2" :src="'/img/flags/'+language+'.svg'" alt="">{{ language }}</at-option>
                        </at-select>
                    </div>
<!--                    <has-error :form="listing" field="language"></has-error>-->
                </div>
                <div class="tw-p-2">
                    <div class="tw-flex tw-flex-row tw-items-baseline">
                        <p class="tw-font-semibold tw-flex tw-mb-1">Background</p>
                        <div v-if="validation.hasError('current.background')" class="tw-flex-1 tw-text-right help-block invalid-feedback">{{ validation.firstError('current.background') }}</div>
                    </div>
                    <at-input v-model="current.background" placeholder="Enter an Image URL" :status="validation.hasError('current.background') ? 'error' : ''"></at-input>
<!--                    <small class="tw-text-blue">(Optimal size 728x350px)</small>-->
<!--                    <has-error :form="listing" field="background"></has-error>-->
                </div>
                <div :class="'bg-'+current.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1 tw-mt-3">
                    <p class="tw-font-bold">Filtering</p>
                </div>
                <div class="tw-p-2">
                    <p class="tw-font-semibold tw-mb-1">Search Tags</p>
                    <at-select v-model="current.tags" multiple>
                        <at-option v-for="(tag, index) in configurations.tags" :key="index" :value="tag">#{{ $t('homepage.tag.'+tag+'.name') }}</at-option>
                    </at-select>
<!--                    <has-error :form="listing" field="tags"></has-error>-->
                </div>
                <div :class="'bg-'+current.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1 tw-mt-3">
                    <p class="tw-font-bold">Images</p>
                </div>
                <div class="tw-p-2">
                    <div class="tw-flex tw-flex-row tw-justify-around">
                        <p class="tw-flex-1 tw-font-semibold tw-mb-1">Screenshots</p>
                        <div class="tw-flex-1 tw-text-right help-block invalid-feedback">{{ validation.firstError('screenshot') }}</div>
                    </div>
                    <div class="tw-flex tw-flex-row">
                        <at-input @keyup.enter.native="addScreenshot" :status="validation.hasError('screenshot') ? 'error' : ''" icon="link" type="url" v-model="screenshot" class="tw-flex-1 tw-mr-2" placeholder="Enter an Image URL"></at-input>
                        <at-button :disabled="validation.hasError('screenshot')" @click="addScreenshot" type="primary" icon="icon-plus"></at-button>
                    </div>
                    <span v-for="(screenshot, i) in current.screenshots">
												<span class="tw-flex tw-flex-row tw-mb-2">
													<at-button @click="removeScreenshot(i)" size="small" icon="icon-trash-2 tw-text-red" class="tw-mr-2" circle></at-button>
													<at-input size="small" :placeholder="screenshot" class="tw-flex-1" disabled></at-input>
												</span>
                  </span>
<!--                    <has-error :form="listing" field="screenshots"></has-error>-->
                </div>
                <div :class="'bg-'+current.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1 tw-mt-3">
                    <p class="tw-font-bold">Content</p>
                </div>
                <div class="tw-p-2">
                    <p class="tw-font-semibold tw-mt-2 tw-mb-3 tw-flex tw-justify-between">Description <small><a class="tw-underline" href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet">MarkDown Syntax Guide</a></small></p>
                    <at-textarea style="margin-left:-.5rem; margin-right:-.5rem;" v-model="current.description" min-rows="15" max-rows="25" placeholder="Write something catchy"></at-textarea>
<!--                    <has-error :form="listing" field="description"></has-error>-->
                </div>
            </at-collapse-item>
            <at-collapse-item name="config">
                <div slot="title">Config File Setup</div>
                <div class="">
                    <div class="mb-3 configuration">
                        <div class="list">
                            <div :class="'bg-'+current.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
                                <p class="tw-font-bold">Player Configuration Setup</p>
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.max_base_level.name') }}</div>
                                <at-input class="value" v-model="current.config.max_base_level" size="small" type="number" placeholder="Please input"></at-input>
<!--                                <has-error :form="listing" field="max_base_level"></has-error>-->
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.max_job_level.name') }}</div>
                                <at-input class="value" v-model="current.config.max_job_level" size="small" type="number" placeholder="Please input"></at-input>
<!--                                <has-error :form="listing" field="max_job_level"></has-error>-->
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.max_aspd.name') }}</div>
                                <at-input class="value" v-model="current.config.max_aspd" size="small" type="number" placeholder="Please input"></at-input>
<!--                                <has-error :form="listing" field="max_aspd"></has-error>-->
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.max_stats.name') }}</div>
                                <at-input class="value" v-model="current.config.max_stats" size="small" type="number" placeholder="Please input"></at-input>
<!--                                <has-error :form="listing" field="max_stats"></has-error>-->
                            </div>
                            <div :class="'bg-'+current.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
                                <p class="tw-font-bold">Experience Points Setup</p>
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.base_exp_rate.name') }}</div>
                                <at-input class="value" v-model="current.config.base_exp_rate" size="small" type="number" placeholder="Please input"></at-input>
<!--                                <has-error :form="listing" field="base_exp_rate"></has-error>-->
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.job_exp_rate.name') }}</div>
                                <at-input class="value" v-model="current.config.job_exp_rate" size="small" type="number" placeholder="Please input"></at-input>
<!--                                <has-error :form="listing" field="job_exp_rate"></has-error>-->
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.quest_exp_rate.name') }}</div>
                                <at-input class="value" v-model="current.config.quest_exp_rate" size="small" type="number" placeholder="Please input"></at-input>
<!--                                <has-error :form="listing" field="quest_exp_rate"></has-error>-->
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.quest_exp_rate.name') }}</div>
                                <at-input class="value" v-model="current.config.quest_exp_rate" size="small" type="number" placeholder="Please input"></at-input>
<!--                                <has-error :form="listing" field="quest_exp_rate"></has-error>-->
                            </div>
                            <div :class="'bg-'+current.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
                                <p class="tw-font-bold">Drop Rate Setup</p>
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.item_drop_common.name') }}</div>
                                <at-input class="value" v-model="current.config.item_drop_common" size="small" type="number"></at-input>
<!--                                <has-error :form="listing" field="item_drop_common"></has-error>-->
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.item_drop_equip.name') }}</div>
                                <at-input class="value" v-model="current.config.item_drop_equip" size="small" type="number" placeholder="Please input"></at-input>
<!--                                <has-error :form="listing" field="item_drop_equip"></has-error>-->
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.item_drop_card.name') }}</div>
                                <at-input class="value" v-model="current.config.item_drop_card" size="small" type="number" placeholder="Please input"></at-input>
<!--                                <has-error :form="listing" field="item_drop_card"></has-error>-->
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.item_drop_common_mvp.name') }}</div>
                                <at-input class="value" v-model="current.config.item_drop_common_mvp" size="small" type="number" placeholder="Please input"></at-input>
<!--                                <has-error :form="listing" field="item_drop_common_mvp"></has-error>-->
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.item_drop_equip_mvp.name') }}</div>
                                <at-input class="value" v-model="current.config.item_drop_equip_mvp" size="small" type="number" placeholder="Please input"></at-input>
<!--                                <has-error :form="listing" field="item_drop_equip_mvp"></has-error>-->
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.item_drop_card_mvp.name') }}</div>
                                <at-input class="value" v-model="current.config.item_drop_card_mvp" size="small" type="number" placeholder="Please input"></at-input>
<!--                                <has-error :form="listing" field="item_drop_card_mvp"></has-error>-->
                            </div>
                            <div :class="'bg-'+current.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
                                <p class="tw-font-bold">Battle Setup</p>
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.instant_cast.name') }}</div>
                                <div class="tw-flex tw-flex-1 tw-justify-end">
                                    <at-radio v-model="current.config.instant_cast_stat" :label="false">No</at-radio>
                                    <at-radio v-model="current.config.instant_cast_stat" :label="true">Yes</at-radio>
                                </div>
<!--                                <has-error :form="listing" field="instant_cast_stat"></has-error>-->
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.pk_mode.name') }}</div>
                                <div class="tw-flex tw-flex-1 tw-justify-end">
                                    <at-radio v-model="current.config.pk_mode" :label="false">No</at-radio>
                                    <at-radio v-model="current.config.pk_mode" :label="true">Yes</at-radio>
                                </div>
<!--                                <has-error :form="listing" field="pk_mode"></has-error>-->
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.arrow_decrement.name') }}</div>
                                <div class="tw-flex tw-flex-1 tw-justify-end">
                                    <at-radio v-model="current.config.arrow_decrement" :label="false">No</at-radio>
                                    <at-radio v-model="current.config.arrow_decrement" :label="true">Yes</at-radio>
                                </div>
<!--                                <has-error :form="listing" field="arrow_decrement"></has-error>-->
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.undead_detect_type.name') }}</div>
                                <div class="tw-flex tw-flex-1 tw-justify-end">
                                    <at-radio v-model="current.config.undead_detect_type" :label="false">No</at-radio>
                                    <at-radio v-model="current.config.undead_detect_type" :label="true">Yes</at-radio>
                                </div>
<!--                                <has-error :form="listing" field="undead_detect_type"></has-error>-->
                            </div>
                            <div class="config">
                                <div class="name">{{ $t('profile.config.attribute_recover.name') }}</div>
                                <div class="tw-flex tw-flex-1 tw-justify-end">
                                    <at-radio v-model="current.config.attribute_recover" :label="false">No</at-radio>
                                    <at-radio v-model="current.config.attribute_recover" :label="true">Yes</at-radio>
                                </div>
<!--                                <has-error :form="listing" field="attribute_recover"></has-error>-->
                            </div>
                        </div>
                    </div>
                </div>
                <at-button @click="updateOrSave" class="tw-w-full" type="primary">Save my new Server</at-button>
            </at-collapse-item>
        </at-collapse>
    </div>
</template>

<script>
    // import sample from 'lodash/sample';
    import {Validator} from 'simple-vue-validator';
    // import { Form, HasError, AlertError } from 'vform'

    export default {
        props: ['current', 'defaultDescription', 'configurations'],
        // components: {
        //     'has-error': HasError,
        //     'alert-error': AlertError,
        // },
        data: function () {
            return {
                screenshot: '',
            }
        },
        methods: {
            updateOrSave() {
                // if (this.listing.slug === null) {
                //     this.listing.post('/listing').then((response) => {
                //         console.log(response);
                //     }).catch((error) => {
                //         this.$Notify({
                //             title: 'Opps!',
                //             message: error.message,
                //             type: 'error'
                //         })
                //     })
                // }
            },
            addTag (newTag) {
                let tag = { name: newTag };
                this.current.commands.push(tag);
                this.commandChoices.push(tag);
            },
            addScreenshot() {
                if (!_.isEmpty(this.screenshot)) {
                    this.current.screenshots.push(this.screenshot);
                    this.screenshot = '';
                }
            },
            removeScreenshot(index) {
                this.current.screenshots.splice(index, 1);
            },
        },
        validators: {
            'current.name': function(value) {
                return Validator.value(value).required().minLength(3).maxLength(255);
            },
            'current.background': function(value) {
                return Validator.value(value).required().url();
            },
            screenshot: function (value) {
                return Validator.value(value).url();
            },
        }
    }
</script>

<!--<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>-->
