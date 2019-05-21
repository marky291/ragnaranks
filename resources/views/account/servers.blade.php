
@component('account.frame', ['selected' => 'servers'])
	@include('format.heading', ['title' => 'My Server Listings'])
	<filtered-listings :initial-listings="{{ $listings }}"></filtered-listings>
@endcomponent