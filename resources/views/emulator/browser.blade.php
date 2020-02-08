@extends('layouts.master')

@section('meta_tags')
    <title>Create New Private Server Listing | Ragnaranks</title>
    <meta name="title" content="Create New Private Server Listing | Ragnaranks">
    <meta name="description" content="Design and upload your server listing on the best ragnarok server finder">
    <meta name="keywords" content="create,new,setup,v4p">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('listing/create') }}">
    <meta property="og:title" content="Create New Private Server Listing | Ragnaranks">
    <meta property="og:description" content="Design and upload your server listing on the best ragnarok server finder">
    <meta property="og:image" content="{{  url('img/meta/og_image.png') }}">
@endsection

@section('wrapper')

    <div class="shadow-inner">
        <div class="tw-container tw-pt-5" id="browser">
            <emulator-browser route="testRoute" inline-template>
                <div class="tw-pb-5 tw-pt-2 tw-flex">
                    <div class="tw-hidden lg:tw-block tw-px-3 lg:tw-w-1/3" id="sidebar">
                        @include('sidebar.message')
                        <emulator-browser-search @item:search="loadSearchedItems"></emulator-browser-search>
                    </div>
                    <div class="tw-px-4 lg:tw-w-2/3 tw-flex tw-flex-wrap">

                        <div v-if="items.meta.total > 0" class="tw-flex tw-flex-row tw-bg-transparent tw-rounded tw-border tw-border-gray-300 tw-mb-6 lg:tw-mb-2 tw-shadow tw-items-center tw-py-2 tw-px-4 tw-justify-between tw-bg-white">
                            <at-button :disabled="items.links.prev == null" @click="changePage(items.meta.current_page - 1)" size="normal" type="primary">« Prev</at-button>
                            <at-pagination @page-change="changePage" :show-quickjump="true" :show-total="true" class="tw-pl-0 tw-mb-0" :current="items.meta.current_page" :page-size="items.meta.per_page" :total="items.meta.total"></at-pagination>
                            <at-button :disabled="items.links.next == null" @click="changePage(items.meta.current_page + 1)" size="normal" type="primary">Next »</at-button>
                        </div>

                        <emulator-browser-items :items="items.data"></emulator-browser-items>

                        <div v-if="items.meta.total > 0" class="tw-flex tw-flex-row tw-bg-transparent tw-rounded tw-border tw-border-gray-300 tw-mb-6 lg:tw-mb-2 tw-shadow tw-items-center tw-py-2 tw-px-4 tw-justify-between tw-bg-white">
                            <at-button :disabled="items.links.prev == null" @click="changePage(items.meta.current_page - 1)" size="normal" type="primary">« Prev</at-button>
                            <at-pagination @page-change="changePage" :show-quickjump="true" :show-total="true" class="tw-pl-0 tw-mb-0" :current="items.meta.current_page" :page-size="items.meta.per_page" :total="items.meta.total"></at-pagination>
                            <at-button :disabled="items.links.next == null" @click="changePage(items.meta.current_page + 1)" size="normal" type="primary">Next »</at-button>
                        </div>

                    </div>
                </div>
            </emulator-browser>
        </div>
    </div>
@endsection
