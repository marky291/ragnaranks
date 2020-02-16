<div class="section">
    <h2>This Container Contains</h2>

    @if (count($item->contains) > 0)
        <div class="browsing-list tw-grid tw-grid-cols-3">
            @foreach ($item->contains as $content)
                <p class="browsing-item tw-col-span-1 tw-flex tw-items-center tw-justify-between tw-px-6">
                    <span class="tw-flex tw-items-center">
                        <img src="{{$content->item->icon}}" alt="" class="tw-mr-2"> <a href="{{ route('database.item', $content->item) }} ">{{ $content->targetName }}</a> 
                    </span>
                    <b>{{ $content->getChance() }}%</b>
                </p>
            @endforeach
        </div>
    @else
        <p>This item cannot be opened</p>
    @endif
</div>