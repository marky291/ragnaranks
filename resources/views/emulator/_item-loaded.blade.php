<div class="load-animation">
    <div class="section">
        <h1>{{ $item->name }}</h1>
        <div class="tw-grid tw-grid-cols-3 tw-gap-6 database-item">
            <div class="tw-col-span-2 tw-py-4 tw-font-normal">
                <p>{!! $item->description !!}</p>
            </div>
            <div class="tw-col-span-1 tw-flex tw-items-start tw-justify-center">
                <img src="{{ $item->image }}" alt="" width="90px">
            </div>
        </div>
    </div>

    <div class="section">
        <h2>Move Information</h2>
        <div class="tw-grid tw-grid-cols-8 tw-gap-1 tw-text-center tw-text-2xl">
            <div class="tw-col-auto tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->drop ? '<i class="fas tw-text-green-500 fa-check-circle"></i>' : '<i class="fas tw-text-red-500 fa-times-circle"></i>' !!}<p class="tw-font-bold tw-text-sm tw-text-green-500">Drop</p></div>
            <div class="tw-col-auto  tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->trade ? '<i class="fas tw-text-green-500 fa-check-circle"></i>' : '<i class="fas tw-text-red-500 fa-times-circle"></i>' !!}<p class="tw-font-bold tw-text-sm tw-text-green-500">Trade</p></div>
            <div class="tw-col-auto  tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->store ? '<i class="fas tw-text-green-500 fa-check-circle"></i>' : '<i class="fas tw-text-red-500 fa-times-circle"></i>' !!} <p class="tw-font-bold tw-text-sm tw-text-green-500">Store</p></div>
            <div class="tw-col-auto tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->cart ? '<i class="fas tw-text-green-500 fa-check-circle"></i>' : '<i class="fas tw-text-red-500 fa-times-circle"></i>' !!} <p class="tw-font-bold tw-text-sm tw-text-green-500">Cart</p></div>
            <div class="tw-col-auto  tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->sell ? '<i class="fas tw-text-green-500 fa-check-circle"></i>' : '<i class="fas tw-text-red-500 fa-times-circle"></i>' !!} <p class="tw-font-bold tw-text-sm tw-text-green-500">Sell</p></div>
            <div class="tw-col-auto  tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->mail ? '<i class="fas tw-text-green-500 fa-check-circle"></i>' : '<i class="fas tw-text-red-500 fa-times-circle"></i>' !!}<p class="tw-font-bold tw-text-sm tw-text-green-500">Mail</p></div>
            <div class="tw-col-auto  tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->auction ? '<i class="fas tw-text-green-500 fa-check-circle"></i>' : '<i class="fas tw-text-red-500 fa-times-circle"></i>' !!}<p class="tw-font-bold tw-text-sm tw-text-green-500">Auction</p></div>
            <div class="tw-col-auto  tw-rounded tw-text-white tw-px-4 tw-py-1">{!! $item->moveinfo->guildstore ? '<i class="fas tw-text-green-500 fa-check-circle"></i>' : '<i class="fas tw-text-red-500 fa-times-circle"></i>' !!}<p class="tw-font-bold tw-text-sm tw-text-green-500">Guild</p></div>
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
                    @if ($item->position !== 'unknown')<p class="browsing-item">Item Location: <b>{{ $item->position }}</b></p>@endif
                    @if ($item->type == 'card')<p class="browsing-item">Item Composition: <b>{{ $item->composition }}</b></p>@endif
                    @if (count($item->supply))<p class="browsing-item">Buyable For: <b>{{ $item->supply->first()->price }} zeny</b></p>@endif
                    <p class="browsing-item">Total Weight: <b>{{ $item->weight }} ea.</b></p>
                    <p class="browsing-item">Dropped by: <b>{{ $item->drops->count() }} Monsters</b></p>
                    <p class="browsing-item">Sold By: <b>{{ $item->supply->count() }} Vendors</b></p>
                    <p class="browsing-item">Contained In: <b>{{ $item->containers->count() }} Boxes</b></p>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <h2>Best Farming Locations</h2>
        <div class="tw-grid tw-grid-cols-2 tw-gap-2">
            @if (count($item->drops) > 0)
                @foreach ($item->drops->bestFarmingSpots()->take(2) as $drop)
                    @if ($drop->monster->spawns->count())
                        <div class="tw-col-span-1">
                            <div class="tw-grid tw-grid-cols-5">
                                <!-- <div class="tw-col-span-1">
                                    <img src="{{ $drop->monster->image }}" style="max-height:35px;max-width:35px;">
                                </div> -->
                                <div class="tw-col-span-5 tw-bg-white tw-py-3">
                                    <div class="tw-mb-2">
                                        <h3><a href="{{ route('database.monster', $drop->monster) }}">{{ $drop->monster->name }}</a> at {{ $drop->rate }}%</h3>
                                        <div class="browsing-list">
                                            @foreach ($drop->monster->spawns->sortByAmount()->take(2) as $spawn)
                                                <p class="browsing-item"><b>{{ $spawn->mapname }}</b> -- spawns {{ $spawn->amount }} mobs</p>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="">
                                        <p class="tw-font-bold tw-mb-1">Damage Bonuses</p>
                                        <div class="properties tw-flex">
                                            @if ($drop->monster->properties)
                                                @if ($drop->monster->properties->neutral > 100)
                                                    <p class="element neutral">Neutral: +{{ $drop->monster->properties->neutral }}%</p>
                                                @endif
                                                @if ($drop->monster->properties->water > 100)
                                                    <p class="element water">Water: +{{ $drop->monster->properties->water }}%</p>
                                                @endif
                                                @if ($drop->monster->properties->earth > 100)
                                                    <p class="element earth">Earth: +{{ $drop->monster->properties->earth }}%</p>
                                                @endif
                                                @if ($drop->monster->properties->fire > 100)
                                                    <p class="element fire">Fire: +{{ $drop->monster->properties->fire }}%</p>
                                                @endif
                                                @if ($drop->monster->properties->wind > 100)
                                                    <p class="element wind">Wind: +{{ $drop->monster->properties->wind }}%</p>
                                                @endif
                                                @if ($drop->monster->properties->poison > 100)
                                                    <p class="element poison">Poison +{{ $drop->monster->properties->poison }}%</p>
                                                @endif
                                                @if ($drop->monster->properties->holy > 100)
                                                    <p class="element holy">Holy: +{{ $drop->monster->properties->holy }}%</p>
                                                @endif
                                                @if ($drop->monster->properties->dark > 100)
                                                    <p class="element dark" style="background:#a55feb">Dark: +{{ $drop->monster->properties->dark }}%</p>
                                                @endif
                                                @if ($drop->monster->properties->ghost > 100)
                                                    <p class="element"  style="background:#aaaaaa">Ghost: +{{ $drop->monster->properties->ghost }}%</p>
                                                @endif
                                                @if ($drop->monster->properties->undead > 100)
                                                    <p class="element undead" style="background:black">Undead: +{{ $drop->monster->properties->undead }}%</p>
                                                @endif
                                            @else
                                            <p>None</p>
                                            @endif
                                        </div>
                                        <!-- <div class="drop-rate">
                                            <p class="tw-font-bold tw-text-lg">{{ $drop->rate }}% Drop</p>
                                        </div> -->
                                    </div>
                                </div>  
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <p>This item cannot be farmed.</p>
            @endif
        </div>
    </div>

    <div class="section color-bg-gray tw--mx-10 tw-py-8 tw-border-b">
        <div class="tw-px-10">
            <h2>Suppliers</h2>
                @if(count($item->supply) > 0)
                <div class="tw-grid tw-grid-cols-2 tw-gap-6">
                    @foreach ($item->supply as $supply)
                        <div class="tw-col-span-1 hover:tw-shadow tw-grid tw-gap-2 tw-grid-cols-5 tw-shadow tw-p-3 tw-rounded tw-bg-white">
                            <div class="tw-col-span-1">
                                <img style="height:75px;" src="{{ $supply->npc->image }}" alt="">
                            </div>
                            <div class="tw-col-span-4">
                                <p class="tw-mb-2">{{ $supply->npc->map->name }}</h3>
                                <h3>{{ ucfirst($supply->npc->type) }} sells at {{ $supply->price }} zeny</h3>
                                <p>{{ $supply->npc->navigation }}</small>
                                <small>{{ $supply->npc->map->mapType }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
                @else
                    <p>There are no suppliers who sell this item.</p>
                @endif
        </div>
    </div>

    <div class="section">
        <h2>Dropped By</h2>
        @if (count($item->drops) > 0)
            <div class="showcase">
                @foreach ($item->drops as $drop)
                    <a href="{{ route('database.monster', $drop->monster) }}">
                        <div class="show monster">
                            <img src="{{ $drop->monster->image }}" alt="{{ $drop->monster->name }}">
                            <p>{{ $drop->monster->name}}</p>
                            <p>{{ $drop->rate }}%</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <p>No monsters drop this item</p>
        @endif
    </div>

    <div class="section">
        <h2>Found Inside</h2>
        @if (count($item->containers) > 0)
            <div class="showcase">
                @foreach ($item->containers as $container)
                    <a href="{{ route('database.item', $container->source) }}">
                        <div class="show item">
                            <img src="{{ $container->source->image }}" alt="{{ $container->source->name }}"> 
                            <p>{{ $container->sourceName }}</p>
                            <p>{{ $container->rate }}% chance</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <p>This item is not contained in any boxes or crates.</p>
        @endif
    </div>

    <div class="section">
        <h2>This Container Contains</h2>
        @if (count($item->contains) > 0)
            <div class="browsing-list tw-grid tw-grid-cols-3">
                @foreach ($item->contains as $content)
                    <p class="browsing-item tw-col-span-1 tw-flex tw-items-center tw-justify-between tw-px-6">
                        <span class="tw-flex tw-items-center">
                            <img src="{{$content->item->icon}}" alt="" class="tw-mr-2"> <a href="{{ route('database.item', $content->item) }} ">{{ $content->targetName }}</a> 
                        </span>
                        <b>{{ $content->rate }}%</b>
                    </p>
                @endforeach
            </div>
        @else
            <p>This item cannot be opened</p>
        @endif
    </div>

</div>