@extends('layouts.master')

@section('title', 'Ragnaranks - Login')
@section('description', 'Sign in to your account and access even more features')
@section('canonical', route('login'))

@section('wrapper')

    <div class="shadow-inner">
        <div class="container">
            <div class="row">
                <div class="w-50 m-auto mt-5 p-2 tw-rounded tw-items-center tw-flex" style="height: 75vh;">
                    <div class="mb-4 tw-flex-1 tw-bg-white px-5 py-4 tw-rounded shadow">
                        <login-component inline-template>
                            <form action="" @keydown="form.onKeydown($event)" @keydown.enter="attemptLogin">
                                <div class="tw-flex tw-flex-row tw-items-center mb-3">
                                    <img src="/img/monsters/poring.png" alt="poring monster" width="75">
                                    <h2 class="ml-2 tw-font-bold mb-0">Be Part of the Community, Login! <br><small>Don't have an account? <span><a href="/register">Register now!</a></span></small></h2>
                                </div>
                                <div class="item-group">
                                    <label for="email">Enter your Email Account</label>
                                    <at-input autocomplete="email" required type="email" autofocus id="email" v-model="form.email" :status="form.errors.has('email') ? 'error' : ''" placeholder="name@example.com" name="email" icon="at-sign"></at-input>
                                    <has-error :form="form" field="email"></has-error>
                                </div>
                                <div class="item-group">
                                    <label for="password" class="tw-font-bold mb-1">Enter your password</label>
                                    <at-input v-model="form.password" :status="form.errors.has('password') ? 'error' : ''" type="password" name="password" icon="user-check"></at-input>
                                    <has-error :form="form" field="password"></has-error>
                                </div>
                                <at-checkbox v-model="form.rememberMe" style="display:inherit" class="mb-4" label="Remember">{{ __('Remember Me') }}</at-checkbox>
                                <at-button @click="attemptLogin" :loading="form.busy" type="primary">{{ __('Login') }}</at-button>
                                <at-button @click="redirect('/password/reset')" type="text">{{ __('Forgot Your Password?') }}</at-button>
                            </form>
                        </login-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
