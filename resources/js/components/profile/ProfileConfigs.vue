<template>
    <div class="">
        <div class="heading">
            <h3>Card Creator</h3>
        </div>
        <at-collapse accordion value="details" class="tw-shadow" style="overflow:visible">
            <at-collapse-item name="details">
                <div slot="title">Detailing</div>
                <div :class="'bg-'+current.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
                    <p class="tw-font-bold">Card Design</p>
                </div>
                <div class="tw-p-2">
                    <div class="tw-flex tw-flex-row tw-items-baseline">
                        <p class="tw-text-left tw-font-semibold tw-mb-1" :style="validation.hasError('current.name') ? 'color:#b3312d' : null">Server Name</p>
                        <div v-if="validation.hasError('current.name')" class="tw-flex-1 tw-text-right help-block invalid-feedback">{{ validation.firstError('current.name') }}</div>
                        <div v-if="current.name && validation.isPassed('current.name')" class="tw-flex-1 tw-text-right help-block tw-text-green-dark" style="font-size:12px;">Available!</div>
                    </div>
                    <div class="tw-flex tw-flex-row">
                        <at-input class="tw-flex-1" v-model="current.name" size="small" placeholder="Please input" :status="validation.hasError('current.name') ? 'error' : ''"></at-input>
                        <div class="validation tw-ml-2">
                            <i v-if="current.name && validation.isPassed('current.name')" class="tw-mr-2 tw-text-green-dark fa fa-check-circle"></i>
                            <i v-if="current.name && !validation.isPassed('current.name') && !validation.isValidating('current.name')" class="tw-mr-2 tw-text-red-dark fa fa-exclamation-circle"></i>
                            <i v-if="validation.isValidating('current.name')" class="tw-ml-2 fa fa-spinner fa-spin"></i>
                        </div>
                    </div>
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
                </div>
                <div class="tw-p-2">
                    <p class="tw-font-semibold tw-mb-1">Main Language</p>
                    <div class="tw-flex">
                        <at-select v-model="current.language" class="tw-capitalize">
                            <at-option v-for="(language, i) in configurations.languages" :key="i" :value="language" :label="language"><img class="tw-w-4 tw-h-4 tw-mr-2" :src="'/img/flags/'+language+'.svg'" alt="">{{ language }}</at-option>
                        </at-select>
                    </div>
                </div>
                <div class="tw-p-2">
                    <p class="tw-font-semibold tw-mb-1">Server Mode</p>
                    <at-select v-model="current.mode">
                        <at-option v-for="(mode, i) in configurations.modes" :key="i" :value="mode">{{ $t('homepage.mode.'+mode+'.name') }}</at-option>
                    </at-select>
                </div>
                <div class="tw-p-2">
                    <div class="tw-flex tw-flex-row tw-items-baseline">
                        <p class="tw-text-left tw-font-semibold tw-mb-1" :style="validation.hasError('current.website') ? 'color:#b3312d' : null">Website HTTP Address</p>
                        <div v-if="validation.hasError('current.website')" class="tw-flex-1 tw-text-right help-block invalid-feedback">{{ validation.firstError('current.website') }}</div>
                    </div>
                    <at-input v-model="current.website" size="small" placeholder="Please input" :status="validation.hasError('current.website') ? 'error' : ''"></at-input>
                </div>
                <div class="tw-p-2">
                    <div class="tw-flex tw-flex-row tw-items-baseline">
                        <p class="tw-font-semibold tw-flex tw-mb-1">Background</p>
                        <div v-if="validation.hasError('current.background')" class="tw-flex-1 tw-text-right help-block invalid-feedback">{{ validation.firstError('current.background') }}</div>
                    </div>
                    <at-input v-model="current.background" placeholder="Enter an Image URL" :status="validation.hasError('current.background') ? 'error' : ''"></at-input>
<!--                    <small class="tw-text-blue">(Optimal size 728x350px)</small>-->
                </div>
                <div :class="'bg-'+current.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1 tw-mt-3">
                    <p class="tw-font-bold">Filtering</p>
                </div>
                <div class="tw-p-2">
                    <p class="tw-font-semibold tw-mb-1">Relatable Tags</p>
                    <at-select v-model="current.tags" multiple>
                        <at-option v-for="(tag, index) in configurations.tags" :key="index" :value="tag">#{{ $t('homepage.tag.'+tag+'.name') }}</at-option>
                    </at-select>
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
                </div>
                <div :class="'bg-'+current.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1 tw-mt-3">
                    <p class="tw-font-bold">Content</p>
                </div>
                <div class="tw-p-2">
                    <div class="tw-flex tw-flex-row tw-items-baseline">
                        <p class="tw-text-left tw-font-semibold tw-mb-1" :style="validation.hasError('current.description') ? 'color:#b3312d' : null">Description</p>
                        <div v-if="validation.hasError('current.description')" class="tw-flex-1 tw-text-right help-block invalid-feedback">{{ validation.firstError('current.description') }}</div>
                    </div>
                    <p class="tw-mb-2"><small><a class="tw-underline" href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet">View the MarkDown Syntax Guide</a></small></p>
                    <at-textarea style="margin-left:-.5rem; margin-right:-.5rem;" :class="validation.hasError('current.description') ? 'invalid-textarea' : ''" v-model="current.description" min-rows="15" max-rows="25" placeholder="Write something catchy"></at-textarea>
                </div>
                <div v-if="isUpdatingCard()">
                    <at-button :loading="validation.isValidating()" type="primary" class="tw-w-full">{{ $t('profile.buttons.update_server') }}</at-button>
                </div>
            </at-collapse-item>
            <at-collapse-item name="config">
                <div slot="title">Configurations</div>
                <div class="">
                    <div class="mb-3 configuration">
                        <div class="list">
                            <div :class="'bg-'+current.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
                                <p class="tw-font-bold">Player Configuration Setup</p>
                            </div>
                            <div class="config">
                                <div class="column">
                                    <div class="name" :style="validation.hasError('current.config.max_base_level') ? 'color:#b3312d' : null">{{ $t('profile.config.max_base_level.name') }}</div>
                                    <div v-if="validation.hasError('current.config.max_base_level')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.max_base_level') }}</div>
                                </div>
                                <at-input class="value" v-model="current.config.max_base_level" size="small" type="number" placeholder="Rate eg. 350x"></at-input>
                            </div>
                            <div class="config">
                                <div class="column">
                                    <div class="name" :style="validation.hasError('current.config.max_job_level') ? 'color:#b3312d' : null">{{ $t('profile.config.max_job_level.name') }}</div>
                                    <div v-if="validation.hasError('current.config.max_job_level')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.max_job_level') }}</div>
                                </div>
                                <at-input class="value" v-model="current.config.max_job_level" size="small" type="number" placeholder="Rate eg. 350x"></at-input>
                            </div>
                            <div class="config">
                                <div class="column">
                                    <div class="name" :style="validation.hasError('current.config.max_aspd') ? 'color:#b3312d' : null">{{ $t('profile.config.max_aspd.name') }}</div>
                                    <div v-if="validation.hasError('current.config.max_aspd')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.max_aspd') }}</div>                                </div>
                                <at-input class="value" v-model="current.config.max_aspd" size="small" type="number" placeholder="Rate eg. 350x"></at-input>
                            </div>
                            <div class="config">
                                <div class="column">
                                    <div class="name" :style="validation.hasError('current.config.max_stats') ? 'color:#b3312d' : null">{{ $t('profile.config.max_stats.name') }}</div>
                                    <div v-if="validation.hasError('current.config.max_stats')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.max_stats') }}</div>                                </div>
                                <at-input class="value" v-model="current.config.max_stats" size="small" type="number" placeholder="Rate eg. 350x"></at-input>
                            </div>
                            <div :class="'bg-'+current.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
                                <p class="tw-font-bold">Experience Points Setup</p>
                            </div>
                            <div class="config">
                                <div class="column">
                                    <div class="name" :style="validation.hasError('current.config.base_exp_rate') ? 'color:#b3312d' : null">{{ $t('profile.config.base_exp_rate.name') }}</div>
                                    <div v-if="validation.hasError('current.config.base_exp_rate')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.base_exp_rate') }}</div>
                                </div>
                                <at-input class="value" v-model="current.config.base_exp_rate" size="small" type="number" placeholder="Rate eg. 350x"></at-input>
                            </div>
                            <div class="config">
                                <div class="column">
                                    <div class="name" :style="validation.hasError('current.config.job_exp_rate') ? 'color:#b3312d' : null">{{ $t('profile.config.job_exp_rate.name') }}</div>
                                    <div v-if="validation.hasError('current.config.job_exp_rate')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.job_exp_rate') }}</div>
                                </div>
                                <at-input class="value" v-model="current.config.job_exp_rate" size="small" type="number" placeholder="Rate eg. 350x"></at-input>
                            </div>
                            <div class="config">
                                <div class="column">
                                    <div class="name" :style="validation.hasError('current.config.quest_exp_rate') ? 'color:#b3312d' : null">{{ $t('profile.config.quest_exp_rate.name') }}</div>
                                    <div v-if="validation.hasError('current.config.quest_exp_rate')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.quest_exp_rate') }}</div>
                                </div>
                                <at-input class="value" v-model="current.config.quest_exp_rate" size="small" type="number" placeholder="Rate eg. 350x"></at-input>
                            </div>
                            <div :class="'bg-'+current.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
                                <p class="tw-font-bold">Drop Rate Setup</p>
                            </div>
                            <div class="config">
                                <div class="column">
                                    <div class="name" :style="validation.hasError('current.config.item_drop_common') ? 'color:#b3312d' : null">{{ $t('profile.config.item_drop_common.name') }}</div>
                                    <div v-if="validation.hasError('current.config.item_drop_common')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.item_drop_common') }}</div>
                                </div>
                                <at-input class="value" v-model="current.config.item_drop_common" size="small" type="number" placeholder="Rate eg. 350x"></at-input>
                            </div>
                            <div class="config">
                                <div class="column">
                                    <div class="name" :style="validation.hasError('current.config.item_drop_equip') ? 'color:#b3312d' : null">{{ $t('profile.config.item_drop_equip.name') }}</div>
                                    <div v-if="validation.hasError('current.config.item_drop_equip')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.item_drop_equip') }}</div>
                                </div>
                                <at-input class="value" v-model="current.config.item_drop_equip" size="small" type="number" placeholder="Rate eg. 350x"></at-input>
                            </div>
                            <div class="config">
                                <div class="column">
                                    <div class="name" :style="validation.hasError('current.config.item_drop_card') ? 'color:#b3312d' : null">{{ $t('profile.config.item_drop_card.name') }}</div>
                                    <div v-if="validation.hasError('current.config.item_drop_card')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.item_drop_card') }}</div>
                                </div>
                                <at-input class="value" v-model="current.config.item_drop_card" size="small" type="number" placeholder="Rate eg. 350x"></at-input>
                            </div>
                            <div class="config">
                                <div class="column">
                                    <div class="name" :style="validation.hasError('current.config.item_drop_common_mvp') ? 'color:#b3312d' : null">{{ $t('profile.config.item_drop_common_mvp.name') }}</div>
                                    <div v-if="validation.hasError('current.config.item_drop_common_mvp')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.item_drop_common_mvp') }}</div>
                                </div>
                                <at-input class="value" v-model="current.config.item_drop_common_mvp" size="small" type="number" placeholder="Please input"></at-input>
                            </div>
                            <div class="config">
                                <div class="column">
                                    <div class="name" :style="validation.hasError('current.config.item_drop_equip_mvp') ? 'color:#b3312d' : null">{{ $t('profile.config.item_drop_equip_mvp.name') }}</div>
                                    <div v-if="validation.hasError('current.config.item_drop_equip_mvp')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.item_drop_equip_mvp') }}</div>
                                </div>
                                <at-input class="value" v-model="current.config.item_drop_equip_mvp" size="small" type="number" placeholder="Rate eg. 350x"></at-input>
                            </div>
                            <div class="config">
                                <div class="column">
                                    <div class="name" :style="validation.hasError('current.config.item_drop_card_mvp') ? 'color:#b3312d' : null">{{ $t('profile.config.item_drop_card_mvp.name') }}</div>
                                    <div v-if="validation.hasError('current.config.item_drop_card_mvp')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.item_drop_card_mvp') }}</div>
                                </div>
                                <at-input class="value" v-model="current.config.item_drop_card_mvp" size="small" type="number" placeholder="Rate eg. 350x"></at-input>
                            </div>
                            <div :class="'bg-'+current.accent+'-dark'" class="tw-text-white tw-rounded tw-px-2 tw-py-1">
                                <p class="tw-font-bold">Battle Setup</p>
                            </div>
                            <div class="config">
                                <div class="column">
                                    <div class="name" :style="validation.hasError('current.config.instant_cast_stat') ? 'color:#b3312d' : null">
                                        {{ $t('profile.config.instant_cast.name') }}
                                        <at-popover trigger="hover" :content="$t('profile.config.instant_cast.describe')" placement="right">
                                            <small class="help-tooltip">[?]</small>
                                        </at-popover>
                                    </div>
                                    <div v-if="validation.hasError('current.config.instant_cast_stat')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.instant_cast_stat') }}</div>
                                </div>
                                <at-radio-group v-model="current.config.instant_cast_stat">
                                    <at-radio :label="0">No</at-radio>
                                    <at-radio :label="1">Yes</at-radio>
                                </at-radio-group>
                            </div>
                            <div class="config">
                                <div class="column">
                                    <div class="name" :style="validation.hasError('current.config.pk_mode') ? 'color:#b3312d' : null">
                                        {{ $t('profile.config.pk_mode.name') }}
                                        <at-popover trigger="hover" :content="$t('profile.config.pk_mode.describe')" placement="right">
                                            <small class="help-tooltip">[?]</small>
                                        </at-popover>
                                    </div>
                                    <div v-if="validation.hasError('current.config.pk_mode')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.pk_mode') }}</div>
                                </div>
                                <at-radio-group v-model="current.config.pk_mode">
                                    <at-radio :label="0">No</at-radio>
                                    <at-radio :label="1">Yes</at-radio>
                                </at-radio-group>
                            </div>
                            <div class="config">
                                <div class="column">
                                     <div class="name" :style="validation.hasError('current.config.arrow_decrement') ? 'color:#b3312d' : null">
                                         {{ $t('profile.config.arrow_decrement.name') }}
                                         <at-popover trigger="hover" :content="$t('profile.config.arrow_decrement.describe')" placement="right">
                                             <small class="help-tooltip">[?]</small>
                                         </at-popover>
                                     </div>
                                    <div v-if="validation.hasError('current.config.arrow_decrement')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.arrow_decrement') }}</div>
                                </div>
                                <at-radio-group v-model="current.config.arrow_decrement">
                                    <at-radio :label="0">No</at-radio>
                                    <at-radio :label="1">Yes</at-radio>
                                </at-radio-group>
                            </div>
                            <div class="config">
                                <div class="column">
                                    <div class="name" :style="validation.hasError('current.config.undead_detect_type') ? 'color:#b3312d' : null">
                                        {{ $t('profile.config.undead_detect_type.name') }}
                                        <at-popover trigger="hover" :content="$t('profile.config.undead_detect_type.describe')" placement="right">
                                            <small class="help-tooltip">[?]</small>
                                        </at-popover>
                                    </div>
                                    <div v-if="validation.hasError('current.config.undead_detect_type')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.undead_detect_type') }}</div>
                                </div>
                                <at-radio-group v-model="current.config.undead_detect_type">
                                    <at-radio :label="0">No</at-radio>
                                    <at-radio :label="1">Yes</at-radio>
                                </at-radio-group>
                            </div>
                            <div class="config">
                                <div class="column">
                                    <div class="name" :style="validation.hasError('current.config.attribute_recover') ? 'color:#b3312d' : null">
                                        {{ $t('profile.config.attribute_recover.name') }}
                                        <at-popover trigger="hover" :content="$t('profile.config.attribute_recover.describe')" placement="bottom">
                                            <small class="help-tooltip">[?]</small>
                                        </at-popover>
                                    </div>
                                    <div v-if="validation.hasError('current.config.attribute_recover')" class="tw-flex-1 help-block invalid-feedback">{{ validation.firstError('current.config.attribute_recover') }}</div>
                                </div>
                                <at-radio-group v-model="current.config.attribute_recover">
                                    <at-radio :label="0">No</at-radio>
                                    <at-radio :label="1">Yes</at-radio>
                                </at-radio-group>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="isCreatingCard()">
                    <at-button @click="updateOrSave" :loading="validation.isValidating()" :disabled="validation.hasError()" class="tw-w-full" type="primary">{{ $t('profile.buttons.save_server')}}</at-button>
                </div>
                <div v-else>
                    <at-button :loading="validation.isValidating()" type="primary" class="tw-w-full">{{ $t('profile.buttons.update_server') }}</at-button>
                    <at-button :loading="validation.isValidating()" type="error" hollow class="tw-w-full tw-mt-1">{{ $t('profile.buttons.delete_server')}}</at-button>
                </div>
            </at-collapse-item>
        </at-collapse>
    </div>
</template>

<script>
    import Form from 'vform';
    import {Validator} from 'simple-vue-validator';

    export default {
        props: ['current', 'defaultDescription', 'configurations'],
        data: function () {
            return {
                screenshot: '',
            }
        },
        methods: {
            updateOrSave() {
                this.$validate().then((success) => {
                    if (success) {
                        let form = new Form(this.current);
                        if (this.isCreatingCard()) {
                            form.post('/listing', this.current.data).then((response) => {
                                window.location.href = response.data.redirect;
                            }).catch((error) => {
                                if (error.status !== 422) {
                                    this.$Notify({
                                        title: 'Opps!',
                                        message: error.message,
                                        type: 'error'
                                    })
                                }
                            })
                        }
                    } else {
                        this.$Notify({
                            title: 'Time for a fix!',
                            message: 'Some fields failed validation and require you to correct the input.',
                            type: 'error'
                        })
                    }
                });
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
            validateNumericField(value) {
                return Validator.value(value).digit().greaterThan(1).lessThan(2147483648).required();
            },
            validateBooleanField(value) {
                return Validator.value(value).required();
            },
            isCreatingCard() {
                return this.current.slug === null;
            },
            isUpdatingCard() {
                return this.isCreatingCard() === false;
            }
        },
        validators: {
            'current.name': {
                debounce: 200,
                validator: function(name) {
                    return Validator.value(name).required().minLength(3).maxLength(255).custom(function () {
                        if (!Validator.isEmpty(name)) {
                            return axios.get('/api/listing/' + name + '/available').then((response) => {
                                if (response.data === false) {
                                    return 'Already taken!';
                                }
                            });
                        }
                    });
                }
            },
            'current.background': function(value) {
                return Validator.value(value).required().url();
            },
            'current.website': function(value) {
                return Validator.value(value).required().url();
            },
            'current.description': function(value) {
                return Validator.value(value).required().minLength(100).maxLength(999);
            },
            'current.config.max_base_level': function(value) {
                return this.validateNumericField(value);
            },
            'current.config.max_job_level': function(value) {
                return this.validateNumericField(value);
            },
            'current.config.max_stats': function(value) {
                return this.validateNumericField(value);
            },
            'current.config.max_aspd': function(value) {
                return this.validateNumericField(value);
            },
            'current.config.base_exp_rate': function(value) {
                return this.validateNumericField(value);
            },
            'current.config.job_exp_rate': function(value) {
                return this.validateNumericField(value);
            },
            'current.config.quest_exp_rate': function(value) {
                return this.validateNumericField(value);
            },
            'current.config.item_drop_common': function(value) {
                return this.validateNumericField(value);
            },
            'current.config.item_drop_equip': function(value) {
                return this.validateNumericField(value);
            },
            'current.config.item_drop_card': function(value) {
                return this.validateNumericField(value);
            },
            'current.config.item_drop_common_mvp': function(value) {
                return this.validateNumericField(value);
            },
            'current.config.item_drop_equip_mvp': function(value) {
                return this.validateNumericField(value);
            },
            'current.config.item_drop_card_mvp': function(value) {
                return this.validateNumericField(value);
            },
            'current.config.pk_mode': function(value) {
                return this.validateBooleanField(value);
            },
            'current.config.castrate_dex_scale': function(value) {
                return this.validateBooleanField(value);
            },
            'current.config.arrow_decrement': function(value) {
                return this.validateBooleanField(value);
            },
            'current.config.undead_detect_type': function(value) {
                return this.validateBooleanField(value);
            },
            'current.config.attribute_recover': function(value) {
                return this.validateBooleanField(value);
            },
            'current.config.instant_cast_stat': function(value) {
                return this.validateBooleanField(value);
            },
            screenshot: function (value) {
                return Validator.value(value).url();
            },

        }
    }
</script>
