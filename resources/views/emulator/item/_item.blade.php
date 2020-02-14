<div class="section">
    <h1>{{ $item->name }}</h1>
    <div class="tw-grid tw-grid-cols-3 tw-gap-6 database-item">
        <div class="tw-col-span-2 tw-py-4 tw-font-normal">
            <p>{!! $item->description !!}</p>
            <!--            <div class="tw-flex tw-mt-4">-->
            <!--                <p class="tw-bg-gray-200 tw-w-full tw-p-1 tw-rounded"><b>//</b> {{ $item->script }}</p>-->
            <!--            </div>-->
        </div>
        <div class="tw-col-span-1 tw-flex tw-items-start tw-justify-center">
            <img src="{{ $item->image }}" alt="" width="90px">
        </div>
    </div>
</div>

<div class="section">
    <h2>Move Information</h2>
    <div class="tw-grid tw-grid-cols-8 tw-gap-1 tw-text-center tw-text-2xl">
        <div class="tw-col-auto tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->drop ? '<i class="fas tw-text-green-500 fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' !!}<p class="tw-font-bold tw-text-sm tw-text-green-500">Drop</p></div>
        <div class="tw-col-auto  tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->trade ? '<i class="fas tw-text-green-500 fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' !!}<p class="tw-font-bold tw-text-sm tw-text-green-500">Trade</p></div>
        <div class="tw-col-auto  tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->store ? '<i class="fas tw-text-green-500 fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' !!} <p class="tw-font-bold tw-text-sm tw-text-green-500">Store</p></div>
        <div class="tw-col-auto tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->cart ? '<i class="fas tw-text-green-500 fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' !!} <p class="tw-font-bold tw-text-sm tw-text-green-500">Cart</p></div>
        <div class="tw-col-auto  tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->sell ? '<i class="fas tw-text-green-500 fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' !!} <p class="tw-font-bold tw-text-sm tw-text-green-500">Sell</p></div>
        <div class="tw-col-auto  tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->mail ? '<i class="fas tw-text-green-500 fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' !!}<p class="tw-font-bold tw-text-sm tw-text-green-500">Mail</p></div>
        <div class="tw-col-auto  tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->auction ? '<i class="fas tw-text-green-500 fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' !!}<p class="tw-font-bold tw-text-sm tw-text-green-500">Auction</p></div>
        <div class="tw-col-auto  tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->guildstore ? '<i class="fas tw-text-green-500 fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>' !!}<p class="tw-font-bold tw-text-sm tw-text-green-500">Guild</p></div>
    </div>
</div>

<div class="section color-bg-gray tw--mx-10 tw-pb-8 tw-border-b">
    <div class="wave" style="height:47px; background: url('/img/layouts/wave-gray.png') no-repeat;"></div>

    <div class="tw-px-10">
        <h2>Quick Glance</h2>
        <div class="tw-shadow tw-bg-white tw-p-4">
            <div class="browsing-list">
                <p class="browsing-item">Item Identifier: <b>#{{ $item->id }}</b></p>
                <p class="browsing-item">Item Type: <b>{{ $item->type }}</b></p>
                <p class="browsing-item">Item Location: <b>{{ $item->location }}</b></p>
                <p class="browsing-item">Item Composition: <b>{{ $item->composition }}</b></p>
                @if (count($item->supply))<p class="browsing-item">Buyable For: <b>{{ $item->supply->first()->price }} zeny</b></p>@endif
                <p class="browsing-item">Total Weight: <b>{{ $item->weight }} ea.</b></p>
                <p class="browsing-item">Dropped by: <b>{{ $item->drops->count() }} Monsters</b></p>
                <p class="browsing-item">Sold By: <b>{{ $item->supply->count() }} Vendors</b></p>
                <p class="browsing-item">Contained In: <b>{{ $item->containers->count() }} Boxes</b></p>
            </div>
        </div>
    </div>
<!--    <div class="tw-col-span-2">-->
<!--        <div class="tw-flex tw-justify-between tw-items-center tw-mb-2">-->
<!--            <h2>Quick Glance</h2>-->
<!--            <img class="tw-mr-2" :src="item.icon" alt="">-->
<!--        </div>-->
<!--        <ul class="browsing-list">-->
<!--            @if (count($item->supply))<li class="browsing-item"><p>Buyable For: <b>{{ $item->supply->first()->price }}</b>z</p></li>@endif-->
<!--            @if ($item->price)<li class="browsing-item"><p>Sellable For: <b>{{ $item->price }}</b>z</p></li>@endif-->
<!--            <li class="browsing-item"><p>Total Weight: <b>{{ $item->weight }} ea.</b></p></li>-->
<!--            <li class="browsing-item"><p>Dropped by: <b>{{ $item->drops->count() }} Monsters</b></p></li>-->
<!--            <li class="browsing-item"><p>Sold By: <b>{{ $item->supply->count() }} Vendors</b></p></li>-->
<!--            <li class="browsing-item"><p>Contained In: <b>{{ $item->containers->count() }} Boxes</b></p></li>-->
<!--        </ul>-->
<!--    </div>-->
</div>
