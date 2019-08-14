@extends('layouts.frame')

@section('title', 'Ragnaranks - Register')
@section('description', 'Create an account and be apart of the growing community')
@section('canonical', route('register'))

@section('content')
    <div class="shadow-inner">
        <div class="container">
            <div class="row">
                <div class="w-50 m-auto mt-5 p-2 tw-rounded tw-items-center tw-flex" style="height: 75vh;">
                    <div class="mb-4 tw-flex-1 tw-bg-white px-5 py-4 tw-rounded shadow">
                        <register-component inline-template>
                            <form action="" @keydown="form.onKeydown($event)" @keydown.enter="attemptRegister">
                                <div class="tw-flex tw-flex-row tw-items-center my-3">
                                    <img src="/img/monsters/lunatic.png" alt="lunatic monster" width="85">
                                    <h2 class="ml-2 tw-font-bold mb-0">Gain access to more features by registerin¸g<br><small>Have an account? <span><a href="/login">Login now!</a></span></small></h2>
                                </div>
                                <div class="item-group">
                                    <label for="username">{{ __('Username') }}</label>
                                    <at-input autocomplete="username" value="{{ old('username') }}" autofocus id="username" v-model="form.username" :status="form.errors.has('username') ? 'error' : ''" placeholder="{{ __('Username') }}" name="username"></at-input>
                                    <has-error :form="form" field="username"></has-error>
                                </div>
                                <div class="item-group">
                                    <label for="email">E-Mail Address</label>
                                    <at-input autocomplete="email" required type="email" id="email" v-model="form.email" :status="form.errors.has('email') ? 'error' : ''" placeholder="{{ __('E-Mail Address') }}" name="email"></at-input>
                                    <has-error :form="form" field="email"></has-error>
                                </div>
                                <div class="item-group">
                                    <label for="password">Password</label>
                                    <at-input autocomplete="password" type="password" id="password" v-model="form.password" :status="form.errors.has('password') ? 'error' : ''" placeholder="{{ __('Password') }}" name="password"></at-input>
                                    <has-error :form="form" field="password"></has-error>
                                </div>
                                <div class="item-group mb-4">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <at-input autocomplete="new-password" type="password" id="password-confirm" v-model="form.password_confirmation" :status="form.errors.has('password_confirmation') ? 'error' : ''" placeholder="{{ __('Confirm Password') }}" name="password_confirmation"></at-input>
                                    <has-error :form="form" field="password_confirmation"></has-error>
                                </div>
                                <div class="action-group">
                                    <at-button @click="attemptRegister" :loading="form.busy" type="primary">{{ __('Register') }}</at-button>
                                </div>
                            </form>
                        </register-component>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
