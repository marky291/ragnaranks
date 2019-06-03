@extends('layouts.frame')

@section('content')
    <div class="tw-bg-grey-lightest">
        <div class="tw-container py-4">
            <account-component :user="{{ auth()->user() }}" inline-template :account="{{ auth()->user()->toJson() }}">
                <div class="row tw-bg-grey-lightest tw-flex">
                    <div class="tw-w-1/4 py-4 tw-flex tw-flex-col tw-items-center">
                        <div class="avatar sm:tw-h-48 tw-w-48 mb-4">
                            <img class="tw-rounded-full shadow tw-border tw-border-grey tw-border-2" :src="account.avatarUrl" alt="">
                        </div>
                        <h4 class="tw-text-lg mb-0 tw-font-bold">{{ auth()->user()->username }}</h4>
                        @if (auth()->user()->hasRole('admin'))
                            <p class="tw-text-red tw-font-bold">Admin</p>
                        @else
                            <p>{{ ucfirst(auth()->user()->roles->first()->name) }}</p>
                        @endif
                        @if(auth()->user()->hasUnlocked(new \App\Achievements\FounderAchievement))
                            <p class="tw-text-purple tw-font-bold">Founder</p>
                        @endif

                        <div class="navigation mt-4">
                            <ul class="list-unstyled">
                                <li class="tw-py-2" {{ $selected === 'account' ? 'selected' : null }}><a class="tw-border-l-4 hover:tw-border-purple tw-px-6 hover:tw-no-underline tw-pb-1 tw-text-sm tw-text-grey-darkest tw-font-bold" href="/account">My Account</a></li>
                                <li class="tw-py-2" {{ $selected === 'notifications' ? 'selected' : null }}><a class="tw-border-l-4 hover:tw-border-purple tw-px-6 hover:tw-no-underline tw-pb-1 tw-text-sm tw-text-grey-darkest" href="/account/notifications">Notifications</a></li>
                                <li class="tw-py-2" {{ $selected === 'servers' ? 'selected' : null }}><a class="tw-border-l-4 hover:tw-border-purple tw-px-6 hover:tw-no-underline tw-pb-1 tw-text-sm tw-text-grey-darkest" href="/account/servers">My Servers</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="tw-w-3/4 my-4 tw-rounded" style="min-height:70vh;">
{{--                        <div class="badges tw-py-4">--}}
{{--                            <div class="tw-rounded tw-bg-white tw-w-16 tw-h-16"><img src="http://i.imgur.com/2DtiCZx.jpg?1" alt=""></div>--}}
{{--                        </div>--}}
                        <div class=" tw-p-6">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </account-component>
        </div>
    </div>
@endsection