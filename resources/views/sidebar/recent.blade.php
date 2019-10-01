<div class="tw-hidden lg:tw-block">
	<div class="heading">
		<h3>Newest Additions</h3>
	</div>
	<div id="additions" class="content tw-shadow py-0 rounded">
		@foreach (\App\Listings\ListingRepository::LatestEntriesCache(5) as $listing)
            <a href="{{ route('listing.show', $listing) }}" style="color:inherit;" class="microcard">
                <div class="tw-px-6 information d-flex flex-row tw-py-3 tw-items-center hover:tw-bg-gray-100" style="{{ $loop->last ? null : 'border-bottom: 1px dashed #e3e3e3;' }}">
                   <div class="wrapper tw-flex tw-flex-row tw-flex-1 tw-items-center tw-justify-between">
                       <div class="details flex-grow-1 tw-leading-relaxed">
                           <p class="title mb-0 tw-text-gray-800" style="font-size:13px;">{{ $listing->name }}</p>
                           <p class="subtitle" style="color:darkgray">Joined {{ $listing->created_at->diffForHumans() }}</p>
                       </div>
                       <div class="align-self-center tw-mr-3">
                           <p class="title">{{ __("homepage.card.rate.{$listing->configuration->exp_title}") }}</p>
                       </div>
                       <i class="cta fas fa-arrow-circle-right tw-text-lg tw-text-blue-400"></i>
                   </div>
                </div>
            </a>
		@endforeach
	</div>
</div>
