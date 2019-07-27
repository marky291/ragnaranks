@component('account.frame', ['selected' => 'account'])
    <account-details-component inline-template>
        <div class="">
            <h3 class="mb-3 tw-text-xl tw-border-b tw-pb-2 tw-font-bold">Account</h3>
            @include('format.inputText', ['model' => 'username', 'title' => 'Username', 'describe' => 'Changing your username may have unintended effects on your account'])
            @include('format.inputText', ['model' => 'email', 'title' => 'E-Mail Address', 'describe' => 'You will be required to validate the email address once changed.'])
            @include('format.inputText', ['model' => 'avatarUrl', 'title' => 'Avatar Image', 'describe' => 'Your public profile image that will appear on reviews you create', 'onChange' => 'sendProfileAvatar'])

            <h3 class="mb-3 tw-text-xl tw-border-b tw-pb-2 tw-font-bold tw-mt-10">Email preferences</h3>
            <div class="">
                <div class="">
                    <at-radio v-model="form.email_preference" class="tw-ml-0 tw-font-bold" label="all">Receive all emails and email notifications.</at-radio>
                    <p class="tw-text-grey-darker tw-ml-6">We will let you know what is happening with things you interacted with and servers you are apart of.</p>
                </div>
                <div class="tw-mt-3">
                    <at-radio v-model="form.email_preference" class="tw-ml-0 tw-font-bold" label="important">Only receive account related emails. (Default)</at-radio>
                    <p class="tw-text-grey-darker tw-ml-6">We will only send emails regarding your account specifically.</p>
                </div>
            </div>

            <at-button @click="saveAccount" :loading="form.busy" type="primary" class="mt-4">Save Changes</at-button>
        </div>
    </account-details-component>
@endcomponent