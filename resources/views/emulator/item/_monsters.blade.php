
<div class="section">
    <h2>Dropped By</h2>

    @if (count($drops) > 0)
        <div class="showcase">
            @foreach ($drops as $drop)
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