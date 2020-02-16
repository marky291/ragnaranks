
<div class="section">
    <h2>Monsters</h2>

    @if (count($drops) > 0)
        <div class="tw-grid tw-grid-cols-6 tw-gap-2">
            @foreach ($drops as $drop)
                <div class="tw-col-span-1">
                    <div class="tw-flex tw-flex-col tw-items-center tw-text-center">
                        <img src="{{ $drop->monster->image }}" alt="" style="max-height:60px;">
                        <p>{{ $drop->monster->name}} ({{ $drop->rate }}%)</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No monsters drop this item</p>
    @endif
</div>