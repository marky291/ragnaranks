@component('account.frame', ['selected' => 'account'])
    <account-details-component inline-template>
        <div class="">
            @include('format.heading', ['title' => 'Update Your Account'])
            @include('format.inputText', ['model' => 'username', 'title' => 'Username'])
            @include('format.inputText', ['model' => 'email', 'title' => 'E-Mail Address'])
            @include('format.inputText', ['model' => 'avatarUrl', 'title' => 'Avatar Image', 'onChange' => 'sendProfileAvatar'])
            <at-button :loading="form.busy" type="primary" class="mt-4">Save Changes</at-button>
        </div>
    </account-details-component>
@endcomponent