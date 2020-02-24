
<div class="panel">
    <div class="heading">
        <h3>Trending Items</h3>
    </div>
    <div class="content tw-grid tw-grid-cols-4 tw-p-5 tw-shadow rounded">
        @if ($cachedItemIconPartial = \Illuminate\Support\Facades\Cache::get('partials.itemIcons'))
            {!! $cachedItemIconPartial !!}
        @else
            <include-fragment src="/api/partials/trending-items">
                @include('sidebar._loading')
            </include-fragment>
        @endif
    </div>
</div>