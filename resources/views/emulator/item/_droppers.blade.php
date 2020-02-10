
<h2 class="heading">Dropped By</h2>

<div class="entity-viewer">
    @foreach ($item->drops as $drop)
        <div class="entity">
            <div class="tw-flex tw-mb-2">
                <div class="tw-mr-2">
                    <img src="{{ $drop->monster->image }}" alt="">
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
            <div class="">
                {{ $drop->monster->properties }}
            </div>
        </div>
    @endforeach
</div>
