@extends('layouts.master')

@section('title', 'Ragnaranks - Forgotton Password')
@section('description', 'Sometimes it happens, let us fix it and set up a new one,')
@section('canonical', route('password.request'))

@section('wrapper')
    <div class="shadow-inner">
        <div class="container">
            <div class="row">
                <div class="w-50 m-auto mt-5 p-2 tw-rounded tw-items-center tw-flex" style="height: 75vh;">
                    <div class="mb-4 tw-flex-1 tw-bg-white px-5 py-4 tw-rounded shadow">
                        <forgot-password-component route="{{ route('password.email') }}" inline-template>
                            <form action="" @keydown="form.onKeydown($event)" @keydown.enter="attemptSendLink">
                                <div class="tw-flex tw-flex-row tw-items-center mb-3">
                                    <img src="http://24.media.tumblr.com/tumblr_m7qx20wrSw1qgquf8o1_500.png" alt="poring monster" width="75">
                                    <h2 class="ml-2 tw-font-bold mb-0">{{ __('Reset Password')  }}!<br><small>Looks like you forgot it, don't worry we can help</small></h2>
                                </div>
                                <div class="item-group">
                                    <label>{{ __('E-Mail Address') }}</label>
                                    <at-input autofocus id="email" v-model="form.email" :status="form.errors.has('email') ? 'error' : ''" placeholder="{{ __('E-Mail Address') }}" name="email"></at-input>
                                    <has-error :form="form" field="email"></has-error>
                                </div>
                                <div class="action-group">
                                    <at-button @click="attemptSendLink" :loading="form.busy" type="primary">{{ __('Send Password Reset Link') }}</at-button>
                                </div>
                            </form>
                        </forgot-password-component>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
