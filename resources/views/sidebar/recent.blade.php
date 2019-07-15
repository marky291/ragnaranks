<div class="tw-hidden lg:tw-block">
	<div class="heading">
		<h3>Newest Additions</h3>
	</div>

	<div id="additions" class="content py-0 rounded">
		@foreach (\App\Listings\ListingRepository::LatestEntriesCache(7) as $listing)
			<div class="microcard" style="{{ $loop->last ? null : 'border-bottom: 1px dashed #e3e3e3;' }}">
				<div class="information d-flex flex-row py-3">
					<div class="icon text-green align-self-center mr-3">
						<i class="fas fa-plus"></i>
					</div>
					<div class="details flex-grow-1">
						<h3 class="mb-0 tw-text-grey-darkest tw-text-xs">{{ $listing->name }}</h3>
						<p class="tw-text-grey-dark tw-text-xs">Created {{ $listing->created_at->format('dS F Y') }}</p>
					</div>
					<div class="buttons w-25 d-flex align-items-center justify-content-end">
						<at-button @click="redirect('{{ route('listing.show', $listing) }}')" type="info">Visit <i class="icon icon-arrow-right"></i></at-button>
						{{--                                    <a href="{{ route('listing.show', $listing) }}" tabindex="0" class="btn btn-blue btn-sm">Visit <i class="icon icon-arrow-right"></i></a>--}}
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>