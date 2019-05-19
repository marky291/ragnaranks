@extends('layouts.frame')

@section('content')
    <div class="shadow-inner">
        <div class="container">
            <div class="row">
                <div class="w-50 m-auto mt-5 p-2 tw-rounded tw-items-center tw-flex" style="height: 75vh;">
                    <div class="mb-4 tw-flex-1 tw-bg-white px-5 py-4 tw-rounded shadow">

                        <register-component inline-template>
                            <form action="" @keydown="form.onKeydown($event)" @keydown.enter="attemptRegister">
                                <div class="tw-flex tw-flex-row tw-items-center my-3">
                                    <h2 class="ml-2 tw-font-bold mb-0">Gain access to more features by registering<br><small>Have an account? <span><a href="/login">Login now!</a></span></small></h2>
                                </div>
                                <div class="item-group">
                                    <label for="email">{{ __('Username') }}</label>
                                    <at-input value="{{ old('username') }}" autofocus id="username" v-model="form.username" :status="form.errors.has('username') ? 'error' : ''" placeholder="{{ __('Username') }}" name="username"></at-input>
                                    <has-error :form="form" field="username"></has-error>
                                </div>
                                <div class="item-group">
                                    <label for="email">E-Mail Address</label>
                                    <at-input id="email" v-model="form.email" :status="form.errors.has('email') ? 'error' : ''" placeholder="{{ __('E-Mail Address') }}" name="email"></at-input>
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
                                <at-button @click="attemptRegister" :loading="form.busy" type="primary">{{ __('Register') }}</at-button>
                            </form>
                        </register-component>

                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
