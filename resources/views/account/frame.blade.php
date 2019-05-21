@extends('layouts.frame')

@section('content')
    <div class="shadow-inner">
        <div class="container py-4">
            <account-component :account="{{ auth()->user()->toJson() }}" inline-template :account="{{ auth()->user()->toJson() }}">
                <div class="row shadow">
                    <div class="col-3 tw-bg-grey-lightest py-4 tw-flex tw-flex-col tw-items-center">
                        <div class="avatar tw-h-32 tw-w-32 mb-4">
                            <img class="tw-rounded-full shadow tw-border tw-border-grey tw-border-2" :src="account.avatarUrl" alt="">
                        </div>
                        <h4 class="tw-text-lg mb-0 tw-font-bold">{{ auth()->user()->username }}</h4>
                        <p class="tw-text-red tw-font-semibold">Member</p>

                        <div class="navigation mt-4">
                            <ul class="list-unstyled">
                                <li {{ $selected === 'account' ? 'selected' : null }}><a href="/account">My Account</a></li>
                                <li {{ $selected === 'notifications' ? 'selected' : null }}><a href="/account/notifications">Notifications</a></li>
                                <li {{ $selected === 'servers' ? 'selected' : null }}>My Servers</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-9 tw-bg-white py-4">
                        {{ $slot }}
                    </div>
                </div>
            </account-component>
        </div>
    </div>
@endsection