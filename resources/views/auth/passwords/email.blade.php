@extends('layouts.frame')

@section('content')
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
                                <alert-success :form="form">We have e-mailed your password reset link!</alert-success>
                                <alert-error :form="form"></alert-error>
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
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

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

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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
