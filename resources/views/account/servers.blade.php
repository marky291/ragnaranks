@section('title', 'Listings | Ragnaranks')
@section('description', 'Manage the servers you listed')

@component('account.frame', ['selected' => 'servers'])
	@include('format.heading', ['title' => 'My Server Listings'])
	<filtered-listings :data="{{ json_encode($listings, true) }}"></filtered-listings>
@endcomponent
