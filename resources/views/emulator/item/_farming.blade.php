
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
                                    <h3><a href="">{{ $drop->monster->name }}</a> at {{ $drop->rate }}%</h3>
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
                                                <p class="element"  style="background:#daaf85">Earth: +{{ $drop->monster->properties->earth }}%</p>
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
