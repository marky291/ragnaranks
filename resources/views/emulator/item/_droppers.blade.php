
<h2 class="heading">Dropped By</h2>

@foreach ($item->drops as $drop)
    {{ $drop->rate }}%
    <ul>
    @foreach ($drop->monster->spawns as $spawn)
        <li>{{ $spawn->mapname }} x {{ $spawn->amount }}</li>
    @endforeach
    {{ $drop->monster->properties }}
    </ul>
    <div class="">
        <img src="{{ $drop->monster->image }}" alt="">
    </div>
@endforeach
