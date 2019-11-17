@extends('layouts.master')

@section('wrapper')
    <profile-frame inline-template clickcount="{{ $listing->ranking->clicks }}" votecount="{{ $listing->ranking->votes }}" trackclick="{{ route('listing.clicks.store', $listing) }}">
        <div class="shadow-inner">
            <div class="tw-container tw-pt-5">
                <div class="tw-pb-5 tw-pt-2 tw-flex">
                    <div class="tw-hidden lg:tw-block tw-px-3 lg:tw-w-1/3" id="sidebar">
                        @include('sidebar.message')
                        @if (request()->segment(3) != '')
                            @include('sidebar.selector')
                            @include('sidebar.reviews')
                            @include('sidebar.recent')
                            @include('sidebar.social')
                        @else
                            @include('sidebar.config')
                        @endif
                    </div>
                    <div class="tw-px-4 lg:tw-w-2/3">
                        <div class="tw-shadow">
                            <div class="mb-3 server-card item flex-fill border rounded use-accent-{{ $listing->accent }}">
                                <div id="profile-card" class="profile-block">
                                    <div class="server-card-head-large image rounded-top" style="height:350px; background-image: url('{{ Storage::url($listing->background) }}')"></div>
                                    <div class="server-card-head-large hover:tw-bg-transparent tw-cursor-pointer overlap tw-flex tw-flex-col tw-justify-between" style="margin-top:-350px;">
                                        <div class="tw-text-right">
                                            @if ($listing->heartbeat->recorder != 'none')
                                                <div class="tw-shadow tw-inline-block tw-px-3 tw-py-1 tw-rounded-l" style="font-size:9px; background-color: rgba(247, 247, 247, 1)">
                                                    <i class="fas fa-circle tw-ml-1 {{ $listing->heartbeat->login == 'online' ? 'tw-text-green-500' : 'tw-text-red-500' }}"></i> Login
                                                    <i class="fas fa-circle tw-ml-1 {{ $listing->heartbeat->char == 'online' ? 'tw-text-green-500' : 'tw-text-red-500' }}"></i> Char
                                                    <i class="fas fa-circle tw-ml-1 {{ $listing->heartbeat->map == 'online' ? 'tw-text-green-500' : 'tw-text-red-500' }}"></i> Map
                                                    @if ($listing->heartbeat->players)
                                                        || <i class="fas fa-gamepad tw-ml-1" style="font-size:12px"></i> {{ $listing->heartbeat->players }}
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                        <div class="tw-flex">
                                            <div class="left-side d-flex w-75 flex-column px-4 py-2 align-self-end">
                                                <h1 class="font-weight-bold mb-0" style="font-size: 26px; color:rgb(243, 243, 243);">{{ $listing->name }}</h1>
                                                <ul class="tag-list tw-flex tw-flex-wrap tw-text-xs tw-text-green-light" style="font-size:13px; margin-bottom: .5rem; width:inherit">
                                                    @foreach($listing->tags as $tag)
                                                        <li class="mr-2">#{{ $tag->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="right-side flex-fill d-flex justify-content-end pr-3" style="padding-bottom:12px;">
                                                <div class="d-flex flex-column justify-content-end mr-3" style="height:100%;">
                                                    <h3 class="card-counter-title mb-0 font-weight-bold transparency">Votes</h3>
                                                    <span class="card-counter font-weight-bold transparency">@{{ votes }}</span>
                                                </div>
                                                <div class="d-flex flex-column justify-content-end mr-2" style="height:100%;">
                                                    <h3 class="card-counter-title mb-0 font-weight-bold transparency">Clicks</h3>
                                                    <span class="card-counter font-weight-bold transparency">@{{ clicks }}</span>
                                                </div>
                                                <div class="d-flex flex-column justify-content-end" style="height:100%;">
                                                    <img class="tw-w-6 tw-h-6 tw-shadow tw-mr-2" src="/img/flags/{{ $listing->language->name }}.svg" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="profile" class="tw-px-10 tw-py-6">
                                    @yield('content')
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </profile-frame>
@endsection
