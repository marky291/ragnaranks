@extends('layouts.frame')

@section('content')
    <div class="">
        <div class="tw-container pt-4">
            <div class="row">
                @if (auth()->check() && !auth()->user()->hasVerifiedEmail())
                    <div class="col-12 pb-3">
                        <at-alert message="Verification Required" description="Your account has limited functionality until you verify the email address!" type="error" show-icon></at-alert>
                    </div>
                @endif
            </div>
            <div class="tw-flex pb-5 pt-2 tw--mx-4 tw-flex-wrap">
                <div id="sidebar" class="lg:tw-w-1/3 tw-px-4">
                    @component('layouts.sidebar')
                        <div class="heading">
                            <h3>Filtered Search</h3>
                        </div>
                        <filtered-search inline-template>
                            <transition name="fade" mode="out-in">
                                <div id="filters" class="d-flex flex-column content p-2 rounded tw-mb-6 lg:tw-mb-0">
                                    <select @change="filterChanged" v-model="rates" class="mb-2 form-control-sm tw-text-grey-dark tw-text-sm tw-bg-grey-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                                        @foreach(trans('homepage.rate') as $key => $rate)
                                            <option value="{{ $key }}">{{ $rate['name'] }}</option>
                                        @endforeach
                                    </select>

                                    <select @change="filterChanged" v-model="mode" class="mb-2 form-control-sm tw-text-grey-dark tw-text-sm tw-bg-grey-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                                        @foreach(trans('homepage.mode') as $key => $mode)
                                            <option value="{{ $key }}">{{ $mode['name'] }}</option>
                                        @endforeach
                                    </select>

                                    <select @change="filterChanged" v-model="tag" class="mb-2 form-control-sm tw-text-grey-dark tw-text-sm tw-bg-grey-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                                        @foreach(trans('homepage.tag') as $key => $tag)
                                            <option value="{{ $key }}">{{ $tag['name'] }}</option>
                                        @endforeach
                                    </select>

                                    <select @change="filterChanged" v-model="sort" class="mb-2 form-control-sm tw-text-grey-dark tw-text-sm tw-bg-grey-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                                        <option value="rank" selected>Sorted by Rank Position</option>
                                        <option value="name">Sorted by Server Name</option>
                                        <option value="created_at">Sorted by Date Added</option>
                                    </select>

                                    <select @change="filterChanged" v-model="paginate" class="form-control-sm tw-text-grey-dark tw-text-sm tw-bg-grey-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                                        <option value="7" selected>And show 7 servers</option>
                                        <option value="15">And show 15 servers</option>
                                        <option value="30">And show 30 servers</option>
                                        <option value="50">And show 50 servers</option>
                                        <option value="100">And show 100 servers</option>
                                    </select>
                                </div>
                            </transition>
                        </filtered-search>
                    @endcomponent
                </div>
                <div class="lg:tw-w-2/3 tw-px-4">
                    <filtered-listings></filtered-listings>
                </div>

            </div>

        </div>
    </div>

@endsection