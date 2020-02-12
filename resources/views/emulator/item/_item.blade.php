<div class="section">
    <h1>{{ $item->name }} #{{ $item->id }}</h1>
    <div class="tw-grid tw-grid-cols-6 tw-gap-6 database-item">
        <div class="tw-col-span-1">
            <img src="{{ $item->image }}" alt="" width="90px">
        </div>
        <div class="tw-col-span-3">
            <p>{!! $item->description !!}</p>
            <p class="tw-mt-2 tw-font-semibold" style="font-size:13px">Type: {{ $item->type }} & {{ $item->subType }}</p>
            <div class="tw-flex tw-mt-4">
                <p class="tw-bg-gray-200 tw-w-full tw-p-1 tw-rounded"><b>//</b> {{ $item->script }}</p>
            </div>
        </div>
        <div class="tw-col-span-2">
            <div class="tw-flex tw-justify-between tw-items-center tw-mb-2">
                <p class="tw-font-bold tw-text-md" style="font-size:13px">Quick Glance</p>
                <img class="tw-mr-2" :src="item.icon" alt="">
            </div>
            <ul class="browsing-list">
                @if (count($item->supply))<li class="browsing-item"><p>Buyable For: <b>{{ $item->supply->first()->price }}</b>z</p></li>@endif
                @if ($item->price)<li class="browsing-item"><p>Sellable For: <b>{{ $item->price }}</b>z</p></li>@endif
                <li class="browsing-item"><p>Total Weight: <b>{{ $item->weight }} ea.</b></p></li>
                <li class="browsing-item"><p>Dropped by: <b>{{ $item->drops->count() }} Monsters</b></p></li>
                <li class="browsing-item"><p>Sold By: <b>{{ $item->supply->count() }} Vendors</b></p></li>
                <li class="browsing-item"><p>Contained In: <b>{{ $item->containers->count() }} Boxes</b></p></li>
            </ul>
        </div>
    </div>
</div>

<div class="section">
    <h2>Move Information</h1>
    <div class="tw-grid tw-grid-cols-8 tw-gap-1 tw-text-center">
        <div class="tw-col-auto tw-shadow {{ $item->moveinfo->drop ? 'tw-bg-green-500' : 'tw-bg-red-500' }} tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->drop ? '<i class="fas tw-text-white fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' !!}<p class="tw-text-sm">Drop</p></div>
        <div class="tw-col-auto tw-shadow {{ $item->moveinfo->trade ? 'tw-bg-green-500' : 'tw-bg-red-500' }} tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->trade ? '<i class="fas tw-text-white fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' !!}<p class="tw-text-sm">Trade</p></div>
        <div class="tw-col-auto tw-shadow {{ $item->moveinfo->store ? 'tw-bg-green-500' : 'tw-bg-red-500' }} tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->store ? '<i class="fas tw-text-white fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' !!} <p class="tw-text-sm">Store</p></div>
        <div class="tw-col-auto tw-shadow {{ $item->moveinfo->cart ? 'tw-bg-green-500' : 'tw-bg-red-500' }} tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->cart ? '<i class="fas tw-text-white fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' !!} <p class="tw-text-sm">Cart</p></div>
        <div class="tw-col-auto tw-shadow {{ $item->moveinfo->sell ? 'tw-bg-green-500' : 'tw-bg-red-500' }} tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->sell ? '<i class="fas tw-text-white fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' !!} <p class="tw-text-sm">Sell</p></div>
        <div class="tw-col-auto tw-shadow {{ $item->moveinfo->mail ? 'tw-bg-green-500' : 'tw-bg-red-500' }} tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->mail ? '<i class="fas tw-text-white fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' !!}<p class="tw-text-sm">Mail</p></div>
        <div class="tw-col-auto tw-shadow {{ $item->moveinfo->auction ? 'tw-bg-green-500' : 'tw-bg-red-500' }} tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->auction ? '<i class="fas tw-text-white fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' !!}<p class="tw-text-sm">Auction</p></div>
        <div class="tw-col-auto tw-shadow {{ $item->moveinfo->guildstore ? 'tw-bg-green-500' : 'tw-bg-red-500' }} tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->guildstore ? '<i class="fas tw-text-white fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' !!}<p class="tw-text-sm">Guild</p></div>
    </div>
</div>
