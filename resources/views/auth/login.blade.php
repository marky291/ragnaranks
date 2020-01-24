@extends('layouts.master')

@section('meta_tags')
    <!-- Primary Meta Tags -->
    <title>Login | Ragnaranks</title>
    <meta name="title" content="Sign in | Ragnaranks">
    <meta name="description" content="Access your private account with our secure login">
    <meta name="keywords" content="login,join,member,access">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('login') }}">
    <meta property="og:title" content="Sign in | Ragnaranks">
    <meta property="og:description" content="Access your private account with our secure login">
    <meta property="og:image" content="{{  url('img/meta/og_image.png') }}">
@endsection

@section('wrapper')

    <div class="shadow-inner">
        <div class="container">
            <div class="row">
                <div class="w-50 m-auto mt-5 p-2 tw-rounded tw-items-center tw-flex" style="height: 75vh;">
                    <div class="mb-4 tw-flex-1 tw-bg-white px-5 py-4 tw-rounded shadow">
                        <login-component inline-template>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="tw-flex tw-flex-row tw-items-center mb-3">
                                    <img src="/img/monsters/poring.png" alt="poring monster" width="75">
                                    <h2 class="ml-2 tw-font-bold mb-0">Be Part of the Community, Login! <br><small>Don't have an account? <span><a href="/register">Register now!</a></span></small></h2>
                                </div>
                                <div class="item-group">
                                    <label for="email">Enter your Email Account</label>
{{--                                    <at-input autocomplete="email" required type="email" autofocus id="email" status="{{$errors->has('email')}}" placeholder="name@example.com" name="email" icon="at-sign"></at-input>--}}

                                    <input id="email" type="email" style="font-size:12px;" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="item-group">
                                    <label for="password" class="tw-font-bold mb-1">Enter your password</label>
                                    <input id="password" type="password" style="font-size:12px;" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <at-checkbox v-model="form.rememberMe" style="display:inherit" class="tw-my-4" label="Remember">{{ __('Remember Me') }}</at-checkbox>
{{--                                <at-button @click="attemptLogin" :loading="form.busy" type="primary">{{ __('Login') }}</at-button>--}}
                                <button type="submit" class="at-btn at-btn--primary">
                                    <span class="at-btn__text">{{ __('Login') }}</span>
                                </button>
                                <a class="at-btn at-btn--text" href="{{ route('password.request') }}">
                                    <span class="at-btn__text">{{ __('Forgot Your Password?') }}</span>
                                </a>
                            </form>
                        </login-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
