<div class="tw-hidden lg:tw-block">
    <div class="heading">
        <h3>Latest Reviews</h3>
    </div>
    <div id="reviews" class="content tw-shadow py-0 rounded">
        @foreach(App\Reviews\ReviewRepository::LatestEntriesCache(5) as $review)
            <a href="{{ route('listing.show', $review->listing) }}" style="color:inherit" class="microcard">
                <div class="tw-px-6 tw-py-3 tw-flex tw-items-center hover:tw-bg-gray-100" style="{{ $loop->last ? null : 'border-bottom: 1px dashed #e3e3e3;' }}">
                    <div class="wrapper tw-flex tw-flex-row tw-flex-1 tw-items-center tw-justify-between">
                        <div class="tw-leading-relaxed">
                            <p class="title font-semibold" style="font-size:13px;"> {{ $review->listing->name }}</p>
                            <div class="tw-flex tw-flex-row" style="color:darkgray">
                                <p class="subtitle">Reviewed by {{ $review->user->username }}</p>
                            </div>
                        </div>
                        <div class="score-box tw-items-center tw-justify-center tw-flex tw-rounded">
                            <p class="title tw-mr-3">{{ $review->percentScore }}% Rating</p>
                            <i class="fas fa-arrow-circle-right tw-text-lg tw-text-blue-400"></i>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
