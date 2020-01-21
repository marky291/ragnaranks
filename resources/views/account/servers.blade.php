@section('title', 'Listings | Ragnaranks')
@section('description', 'Manage the servers you listed')

@section('meta_tags')
    <!-- Primary Meta Tags -->
    <title>Manage Listings | Ragnaranks</title>
    <meta name="title" content="Manage Listings | Ragnaranks">
    <meta name="description" content="Manage the servers listed on ragnaranks">
@endsection

@component('account.frame', ['selected' => 'servers'])
	@include('format.heading', ['title' => 'My Server Listings'])
	<filtered-listings :data="{{ json_encode($listings, true) }}"></filtered-listings>
@endcomponent
