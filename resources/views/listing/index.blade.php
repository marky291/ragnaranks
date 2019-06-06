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
                                    <select @change="filterChanged" v-model="type" class="mb-2 form-control-sm tw-text-grey-dark tw-text-sm tw-bg-grey-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                                        <option value="all" selected>Any Rates</option>
                                        <option value="official-rate">Official Rates</option>
                                        <option value="low-rate">Low Rates</option>
                                        <option value="mid-rate">Mid Rates</option>
                                        <option value="high-rate">High Rates</option>
                                        <option value="super-high-rate">Super High Rates</option>
                                    </select>

                                    <select @change="filterChanged" v-model="mode" class="mb-2 form-control-sm tw-text-grey-dark tw-text-sm tw-bg-grey-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                                        <option value="any" selected>Any Mode</option>
                                        <option value="renewal">Renewal</option>
                                        <option value="pre-renewal">Pre-Renewal</option>
                                        <option value="classic">Official</option>
                                        <option value="custom">Custom</option>
                                    </select>

                                    <select @change="filterChanged" v-model="tag" class="mb-2 form-control-sm tw-text-grey-dark tw-text-sm tw-bg-grey-panel tw-rounded-full tw-px-5 tw-py-3 tw-flex tw-items-center tw-cursor-pointer tw-leading-none">
                                        <option value="all" selected>With Any Tags</option>
                                        <option v-for="tag in tags" :value="tag['tag']">@{{ tag['name'] }}</option>
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
                    <filtered-listings inline-template>
                        <transition-group name="fade" mode="out-in">
                            <div v-for="listing in listings" :key="listing['id']">
                                <div class="mb-3 server-card item flex-fill shadow border rounded">
                                    <div class="server-card-head image rounded-top" v-bind:style="{ 'background-image': 'url(' + listing['background'] + ')' }"></div>
                                    <div class="server-card-head overlap d-flex">
                                        <div class="left-side d-flex w-75 flex-column align-items-start px-4 py-2 align-self-end">
                                            <h1 class="text-white font-weight-bold mb-0" style="font-size: 24px;">@{{ listing['name'] }}</h1>
                                            <ul class="tag-list tw-list-reset tw-flex tw-text-xs tw-text-green-light">
                                            <span v-for="tag in listing.tags">
                                                <li class="mr-2">#@{{ tag['name']}}</li>
                                            </span>
                                            </ul>
                                        </div>
                                        <div class="right-side flex-fill d-flex justify-content-end pr-3" style="padding-bottom:12px;">
                                            <div class="d-flex flex-column justify-content-end mr-3" style="height:100%;">
                                                <h3 class="card-counter-title mb-0 font-weight-bold transparency">Votes</h3>
                                                <span class="card-counter font-weight-bold transparency">@{{ listing['votes_count']}}</span>
                                            </div>
                                            <div class="d-flex flex-column justify-content-end mr-2" style="height:100%;">
                                                <h3 class="card-counter-title mb-0 font-weight-bold transparency">Clicks</h3>
                                                <span class="card-counter font-weight-bold transparency">@{{ listing['clicks_count']}}</span>
                                            </div>
                                            <div class="d-flex flex-column justify-content-end" style="height:100%;">
                                                <img class="tw-w-6 tw-h-6 tw-shadow tw-mr-2" :src="'/img/flags/'+listing['language']['name']+'.svg'" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="server-card-body align-items-center px-4 py-3 d-flex">
                                        <div class="rating rounded-circle mr-3 d-flex font-weight-bold justify-content-center align-items-center" style="min-height:50px; min-width:50px;">
                                            @{{ listing['rank'] }}
                                        </div>
                                        <div class="flex-fill pr-3">
                                            <p class="font-weight-bold mb-0">@{{ listing['type'] }} (@{{ listing['configs']['base_exp_rate'] }}x/@{{ listing['configs']['job_exp_rate']}}x)</p>
                                            <p class="text-muted">@{{ listing['description']}}</p>
                                        </div>

                                        <at-button @click="visit(listing['slug'])" type="info">Visit <i class="icon icon-arrow-right"></i></at-button>
                                    </div>
                                </div>
                            </div>
                        </transition-group>
                    </filtered-listings>
                </div>

            </div>

        </div>
    </div>

@endsection