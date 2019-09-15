<div class="tw-hidden lg:tw-block">
	<div class="heading">
		<h3>Newest Additions</h3>
	</div>

	<div id="additions" class="content tw-shadow py-0 rounded">
		@foreach (\App\Listings\ListingRepository::LatestEntriesCache(5) as $listing)
			<div class="microcard" style="{{ $loop->last ? null : 'border-bottom: 1px dashed #e3e3e3;' }}">
                    <div class="information d-flex flex-row tw-py-3 tw-items-center">
                        {{--                    <div class="align-self-center tw-mr-3" style="color:darkgrey">--}}
                        {{--                        <i class="fas fa-glass-cheers"></i>--}}
                        {{--                    </div>--}}
                        <div class="details flex-grow-1 tw-leading-relaxed">
                            <h3 class="mb-0 tw-text-gray-800" style="font-size:13px;">{{ $listing->name }}</h3>
                            <p style="color:darkgray">Joined {{ $listing->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="align-self-center tw-mr-3">
                            <p>{{ __("homepage.card.rate.{$listing->configuration->exp_title}") }}</p>
                        </div>
                        <i class="fas fa-arrow-circle-right tw-text-lg tw-text-blue-400"></i>
                        {{--					<div class="buttons w-25 d-flex align-items-center justify-content-end">--}}
                        {{--						<at-button @click="redirect('{{ route('listing.show', $listing) }}')" type="info">Visit <i class="icon icon-arrow-right"></i></at-button>--}}
                        {{--					</div>--}}
                    </div>
			</div>
		@endforeach
	</div>
</div>
