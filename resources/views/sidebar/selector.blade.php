<div class="heading">
	<h3>Interactions</h3>
</div>

@if (request()->segment(3) != '')
    <div class="tw-flex tw-flex-col content tw-shadow-md tw-py-1 rounded tw-mb-4" id="user-actions">
        <a class="selector-item" href="{{ route('listing.show', $listing) }}">
            <div class="hover:tw-bg-gray-100 tw-items-center tw-py-3 tw-px-6 tw-flex">
                <div class="tw-pr-4 tw-leading-snug">
                    <h5 class="tw-mb-1">Back to Main Profile</h5>
                    <p class="tw-text-gray-600">Go back to the main overview of this listings profile.</p>
                </div>
                <i class="icon tw-text-gray-600 tw-text-xl fas fa-undo-alt"></i>
            </div>
        </a>
    </div>
@endif

<div class="tw-flex tw-flex-col content tw-shadow-md tw-py-1 rounded" id="user-actions">
    <a class="selector-item" href="{{ $listing->website }}" target="_blank">
        <div class="hover:tw-bg-gray-100 tw-items-center tw-py-3 tw-px-6 tw-flex tw-border-b tw-border-gray-200">
            <div class="tw-pr-4 tw-leading-snug">
                <h5 class="tw-mb-1">Server Website</h5>
                <p class="tw-text-gray-600">Redirect to their website and learn more on about what is on offer.</p>
            </div>
            <i class="icon tw-text-gray-600 tw-text-xl fas fa-external-link-alt"></i>
        </div>
    </a>
    <a class="selector-item {{ request()->segment(3) == 'reviews' ? 'active' : '' }} bc-deviling-dark tw-border-l-4" href="{{ route('listing.reviews.index', $listing) }}">
        <div class="tw-items-center tw-py-3 tw-px-6 tw-flex tw-border-b tw-border-gray-200">
            <div class="tw-pr-4 tw-leading-snug">
                <h5 class="tw-mb-1 text-{{$listing->accent}}-base">Review Explorer</h5>
                <p class="tw-text-gray-600">Examine reviews on this server by other players or create your own.</p>
            </div>
            <i class="icon tw-text-gray-600 tw-text-xl far fa-edit"></i>
        </div>
    </a>
    <a class="selector-item" href="#">
        <div class="hover:tw-bg-gray-100 tw-items-center tw-py-3 tw-px-6 tw-flex tw-border-b tw-border-gray-200">
            <div class="tw-pr-4 tw-leading-snug">
                <h5 class="tw-mb-1">Vote Dispatcher</h5>
                <p class="tw-text-gray-600">Contribute your points towards this server or checkout some graphs.</p>
            </div>
            <i class="icon tw-text-gray-600 tw-text-xl far fa-thumbs-up"></i>
        </div>
    </a>
    <a class="selector-item" href="#">
        <div class="hover:tw-bg-gray-100 tw-items-center tw-py-3 tw-px-6 tw-flex">
            <div class="tw-pr-4 tw-leading-snug">
                <h5 class="tw-mb-1">Back to Searching</h5>
                <p class="tw-text-gray-600">Not what you were looking for, lets go back and find another.</p>
            </div>
            <i class="icon tw-text-gray-600 tw-text-xl far fa-arrow-alt-circle-left"></i>
        </div>
    </a>
</div>
