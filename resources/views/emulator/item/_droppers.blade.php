
<h2 class="heading tw-font-bold">Best Farming Locations</h2>

<div class="entity-viewer">
    @foreach ($item->drops->bestFarmingSpots()->take(6) as $drop)
        @if ($drop->monster->spawns->count())
            <div class="entity">
                <div class="tw-flex tw-mb-2">
                    <div class="tw-mr-2">
                        <img src="{{ $drop->monster->image }}" style="max-height:35px;max-width:35px;" alt="">
                    </div>
                    <div class="">
                        <b>{{ $drop->monster->name }}</b>
                        <p>{{ $drop->rate }}% Drop Rate</p>
                    </div>
                </div>
                <div class="entity-list">
                    @foreach ($drop->monster->spawns as $spawn)
                        <p class="list-item">{{ $spawn->mapname }} x {{ $spawn->amount }}</p>
                    @endforeach
                </div>
                {{--            <div class="">--}}
                {{--                {{ $drop->monster->properties }}--}}
                {{--            </div>--}}
            </div>
        @endif
    @endforeach
</div>
