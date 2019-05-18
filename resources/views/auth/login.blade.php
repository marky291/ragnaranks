@extends('layouts.frame')

@section('content')

    <div class="shadow-inner">
        <div class="container">
            <div class="row">
                <div class="w-50 m-auto mt-5 p-2 tw-rounded tw-items-center tw-flex" style="height: 75vh;">
                    <div class="mb-4 tw-flex-1 tw-bg-white px-5 py-4 tw-rounded shadow">
                        <div class="tw-flex tw-flex-row tw-items-center mb-3">
                            <img src="https://pngimage.net/wp-content/uploads/2018/06/poring-png-4.png" alt="poring monster" width="75">
                            <h2 class="ml-2 tw-font-bold mb-0">Be Part of the Community, Login! <br><small>Don't have an account? <span><a href="">Register now!</a></span></small></h2>
                        </div>
                        <div class="mb-3">
                            <p class="tw-font-bold mb-1">Enter your Email Account</p>
                            <at-input v-model="inputValue" placeholder="Email"></at-input>
                        </div>
                        <div class="mb-4">
                            <p class="tw-font-bold mb-1">Enter your password</p>
                            <at-input v-model="inputValue" type="password" placeholder="Password"></at-input>
                        </div>
                        <at-checkbox v-model="checkboxValue1" style="display:inherit" class="mb-4" label="Remember">Remember me</at-checkbox>
                        <at-button type="primary">Login</at-button>
                        <at-button type="text">Forgot Yout Password?</at-button>
                    </div>
                </div>
            </div>
        </div>
    </div>



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
