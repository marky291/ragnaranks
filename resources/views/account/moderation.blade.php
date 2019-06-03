@component('account.frame', ['selected' => 'notifications'])
	@include('format.heading', ['title' => 'Moderation Tools'])

	@foreach ($reports as $report)
		{{ $report }}
	@endforeach
@endcomponent