<div class="tw-hidden lg:tw-block">
	<div class="heading">
		<h3>Newest Servers</h3>
	</div>
	<div id="additions" class="content tw-shadow py-0 rounded">
        <div class="tip">
            @if ($cachedLatestServersPartial = \Illuminate\Support\Facades\Cache::get('partials.latest-servers'))
                {!! $cachedLatestServersPartial !!}
            @else
                <include-fragment src="/api/partials/latest-servers">
                    @include('sidebar._listing-placeholder')
                </include-fragment>
            @endif
        </div>
	</div>
</div>
