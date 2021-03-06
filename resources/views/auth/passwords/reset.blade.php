@extends('layouts.master')

@section('wrapper')
    <div class="shadow-inner">
        <div class="container">
            <div class="row">
                <div class="w-50 m-auto mt-5 p-2 tw-rounded tw-items-center tw-flex" style="height: 75vh;">
                    <div class="mb-4 tw-flex-1 tw-bg-white px-5 py-4 tw-rounded shadow">
                        <reset-password-component route="{{ route('password.update') }}" form_token="{{ $token }}" inline-template>
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="tw-flex tw-flex-row tw-items-center mb-3">
                                    <img src="https://i.pinimg.com/originals/d9/35/46/d935462f496db09ee9f01da26ff17922.jpg" alt="poring monster" width="75">
                                    <h2 class="ml-2 tw-font-bold mb-0">The final part to resetting your password! <br><small>It was a long journey, but you made it</small></h2>
                                </div>
                                <div class="item-group">
                                    <label>{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" style="font-size:12px;" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="item-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" style="font-size: 12px;" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="item-group mb-4">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" style="font-size:12px;" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    <has-error :form="form" field="password_confirmation"></has-error>
                                </div>
                                <div class="action-group">
                                    <button type="submit" class="at-btn at-btn--primary">
                                        <span class="at-btn__text">{{ __('Reset Password') }}</span>
                                    </button>
                                </div>
                            </form>
                        </reset-password-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
