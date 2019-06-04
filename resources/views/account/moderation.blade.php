@component('account.frame', ['selected' => 'notifications'])
	@include('format.heading', ['title' => 'Moderation Tools'])
		@foreach ($reports as $report)
			<report-tool-component inline-template>
				<?php /** @var \App\Interactions\Review $review */ ?>
				@if ($report->reportable instanceof \App\Interactions\Review)
					<div class="tw-mb-5">
						<p class="tw-font-bold tw-text-lg tw-mb-2">Case #{{ $report->getKey() }}</p>
						<p class="tw-font-semibold tw-mb-2">A review was reported {{ $report->created_at->diffForHumans() }} by <span class="tw-text-blue">{{$report->reporter->username}}</span> for the reason: {{ $report->reason  }}</p>
						<p>{{ $report->reportable->message }}</p>
						<div class="tw-mt-3">
							<at-button @click="update('{{route('report.update', $report)}}')" :loading="updating.busy" type="info" size="small">Allow</at-button>
							<at-button @click="destroy('{{route('report.destroy', $report)}}')" :loading="destroying.busy" type="error" size="small" hollow>Remove</at-button>
						</div>
					</div>
				@endif
			</report-tool-component>
		@endforeach
@endcomponent