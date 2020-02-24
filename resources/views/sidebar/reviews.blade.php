<div class="tw-hidden lg:tw-block">
    <div class="heading">
        <h3>Latest Reviews</h3>
    </div>
    <div id="reviews" class="content tw-shadow py-0 rounded">
        <div class="tip">
            @if ($cachedLatestReviewsPartial = \Illuminate\Support\Facades\Cache::get('partials.latest-reviews'))
                {!! $cachedLatestReviewsPartial !!}
            @else
                <include-fragment src="/api/partials/latest-reviews">
                    @include('sidebar._loading')
                </include-fragment>
            @endif
        </div>
    </div>
</div>
