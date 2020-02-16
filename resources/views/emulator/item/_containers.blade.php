<div class="section color-bg-gray tw--mx-10 tw-py-8">
    <div class="tw-px-10">
        <h2>Containers</h2>
        
        @if (count($item->containers) > 0)
            <div class="tw-grid tw-grid-cols-6 tw-gap-2">
                @foreach ($item->containers as $container)
                    <div class="tw-col-span-1">
                        <a href="{{ route('database.item', $container->source) }}">
                            <p class="tw-flex tw-flex-col tw-items-center tw-text-center"><img src="{{ $container->source->image }}" alt=""> {{ $container->sourceName }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p>This item is not contained in any boxes or crates.</p>
        @endif
    </div>
</div>