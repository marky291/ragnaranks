@extends('layouts.master')

@section('wrapper')
    <div class="shadow-inner">
        <div class="container">
            <div class="row">
                <div class="w-50 m-auto mt-5 p-2 tw-rounded tw-items-center tw-flex" style="height: 75vh;">
                    <div class="mb-4 tw-flex-1 tw-bg-white px-5 py-4 tw-rounded shadow">
                        <reset-password-component route="{{ route('password.update') }}" form_token="{{ $token }}" inline-template>
                            <form action="" @keydown="form.onKeydown($event)" @keydown.enter="attemptSendReset">
                                <div class="tw-flex tw-flex-row tw-items-center mb-3">
                                    <img src="https://i.pinimg.com/originals/d9/35/46/d935462f496db09ee9f01da26ff17922.jpg" alt="poring monster" width="75">
                                    <h2 class="ml-2 tw-font-bold mb-0">The final part to resetting your password! <br><small>It was a long journey, but you made it</small></h2>
                                </div>
                                <div class="item-group">
                                    <label>{{ __('E-Mail Address') }}</label>
                                    <at-input autofocus id="email" v-model="form.email" :status="form.errors.has('email') ? 'error' : ''" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ $email }}"></at-input>
                                    <has-error :form="form" field="email"></has-error>
                                </div>
                                <div class="item-group">
                                    <label for="password">Password</label>
                                    <at-input type="password" id="password" v-model="form.password" :status="form.errors.has('password') ? 'error' : ''" placeholder="{{ __('Password') }}" name="password"></at-input>
                                    <has-error :form="form" field="password"></has-error>
                                </div>
                                <div class="item-group mb-4">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <at-input type="password" id="password-confirm" v-model="form.password_confirmation" :status="form.errors.has('password_confirmation') ? 'error' : ''" placeholder="{{ __('Confirm Password') }}" name="password_confirmation"></at-input>
                                    <has-error :form="form" field="password_confirmation"></has-error>
                                </div>
                                <div class="action-group">
                                    <at-button @click="attemptSendReset" :loading="form.busy" type="primary">{{ __('Reset Password') }}</at-button>
                                </div>
                            </form>
                        </reset-password-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
