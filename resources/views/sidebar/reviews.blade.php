<div class="tw-hidden lg:tw-block">
    <div class="heading">
        <h3>Latest Reviews</h3>
    </div>

    <div id="reviews" class="content tw-shadow py-0 rounded">
        @foreach(App\Reviews\ReviewRepository::LatestEntriesCache(5) as $review)
            <div class="tw-py-3 tw-flex tw-items-center" style="{{ $loop->last ? null : 'border-bottom: 1px dashed #e3e3e3;' }}">
{{--                @switch($review->average_score)--}}
{{--                    @case(1) <i class="text-green far fa-meh tw-mr-3"></i> @break;--}}
{{--                    @case(2) <i class="text-green far fa-smile tw-mr-3"></i> @break;--}}
{{--                    @case(3) <i class="text-green far fa-grin tw-mr-3"></i> @break;--}}
{{--                    @case(4) <i class="text-green far fa-grin-beam tw-mr-3"></i> @break;--}}
{{--                    @case(5) <i class="text-green far fa-grin-hearts tw-mr-3"></i> @break;--}}
{{--                @endswitch--}}
{{--                <i class="fas fa-keyboard tw-mr-3" style="color:darkgray"></i>--}}
                <div class="tw-flex tw-flex-row tw-flex-1 tw-items-center tw-justify-between">
                    <div class="tw-leading-relaxed">
                        <p class="font-semibold" style="font-size:13px;"> {{ $review->listing->name }}</p>
                        <div class="tw-flex tw-flex-row" style="color:darkgray">
{{--                            <p><i class="fas fa-server tw-mr-1"></i> {{ __("homepage.card.rate.{$review->listing->configuration->exp_title}") }}</p>--}}
{{--                            <p><i class="fas fa-clock tw-ml-2"></i> {{ $review->created_at->diffForHumans() }}</p>--}}
                            <p>Reviewed by {{ $review->user->username }}</p>
                        </div>
                    </div>
                    <div class="score-box tw-items-center tw-justify-center tw-flex tw-rounded">
                        <p class="tw-mr-3">{{ $review->percentScore }}% Rating</p>
                        <i class="fas fa-arrow-circle-right tw-text-lg tw-text-blue-400"></i>
                    </div>
                </div>
{{--                <a href="#" name="View {{ $review->listing->name }} profile on Ragnaranks" class="at-btn tw-shadow hover:tw-text-white at-btn--primary at-btn__text" style="display:flex">Visit <i class="icon icon-arrow-right"></i></a>--}}
            </div>
        @endforeach
    </div>
</div>
