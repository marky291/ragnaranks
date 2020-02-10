<div class="">
    <h2 class="heading">Sellers</h2>

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

</div>
