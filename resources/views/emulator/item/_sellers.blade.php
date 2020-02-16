<div class="section color-bg-gray tw--mx-10 tw-py-8 tw-border-b">
    <div class="tw-px-10">
        <h2>Suppliers</h2>
            @if(count($supplies) > 0)
            <div class="tw-grid tw-grid-cols-2 tw-gap-6">
                @foreach ($supplies as $supply)
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
