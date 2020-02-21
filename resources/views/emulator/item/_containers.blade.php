<div class="section tw--mx-10 tw-py-8">
    <div class="tw-px-10">
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
</div>