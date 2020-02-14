<div class="section color-bg-gray tw--mx-10 tw-py-8 tw-border-b">
    <div class="tw-px-10">
        <h2>Suppliers</h2>
        <div class="tw-grid tw-grid-cols-3 tw-gap-6">
            @foreach ($item->supply as $supply)
                <div class="tw-col-span-1 tw-grid tw-gap-2 tw-grid-cols-3 tw-shadow tw-p-3 tw-rounded tw-bg-white">
                    <div class="tw-col-span-1">
                        <img src="{{ $supply->npc->image }}" alt="">
                    </div>
                    <div class="tw-col-span-2">
                        <h3>Npc Name sells for 0 zeny</h3>
                        <h3>{{ $supply->npc->type }}</h3>
                        <at-input readonly>{{ $supply->npc->mapname }}</at-input>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- 
    <div class="">
        @foreach ($item->supply as $supply)
            <div class="">
                <img src="" alt="">
                <b>{{ $supply->npc->mapname }}, {{ $supply->npc->x }}, {{ $supply->npc->y }}</b>
                {{ $supply->npc }}
                {{ $supply->npc->type }}
                {{ $supply->npc->id }}
                <ul>
                    @foreach ($supply->npc->inventory as $inventory)
                        <li class="tw-flex"><img src="{{$inventory->item->icon}}" alt=""> {{ $inventory->item->name }} {{ $inventory->price }}z</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

</div> -->
