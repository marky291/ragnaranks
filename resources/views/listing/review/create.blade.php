

@if (count($userReviews))
    <h5>You have already made a {{ Str::plural('review', count($userReviews)) }} on this listing</h5>
    <p>You can modify your review if you need, or simply leave it be.</p>
    @foreach ($userReviews as $review)
        {{ var_dump($review) }}
    @endforeach
@endif
