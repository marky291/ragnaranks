@section('title', 'Notifications | Ragnaranks')
@section('description', 'Manage incoming account notifications')

@section('meta_tags')
    <!-- Primary Meta Tags -->
    <title>Notifications | Ragnaranks</title>
    <meta name="title" content="Notifications | Ragnaranks">
    <meta name="description" content="View all your account notifications">
    <meta name="keywords" content="notificatons,account">
@endsection

@component('account.frame', ['selected' => 'notifications'])
	@include('format.heading', ['title' => 'Notifications'])

	@foreach ($notifications as $notification)
		<account-notification-component id="{{ $notification->getKey() }}" status="{{ $notification->read() }}" inline-template>
			<div class="notification tw-bg-white tw-py-4 tw-px-4 tw-rounded tw-shadow tw-border tw-mb-2 tw-flex">
				<div class="">
					<img v-if="!read" src="/img/icons/icon_status_mail_unread.png" alt="">
					<img v-if="read" src="/img/icons/icon_status_mail_read.png" alt="">
				</div>
				<div class="">
					<div class="tw-ml-4">
						<h4 class="tw-font-semibold tw-mb-0">{{ $notification->data['title'] }}</h4>
						<p class="tw-text-xs tw-text-gray-700 tw-mb-2">{{ $notification->created_at->diffForHumans() }}</p>
						<p>{{ $notification->data['message'] }}</p>
						@if (isset($notification->data['link']))
							<a href="{{ $notification->data['link'] }}">View</a>
						@endif
					</div>
					<div class="tw-mt-3 tw-bg-gray-100 tw-rounded-full">
						<at-button v-if="!read" @click="markRead" type="text"><i class="icon icon-eye tw-mr-1"></i>Mark as read</at-button>
						<at-button v-if="read" @click="markUnread" type="text"><i class="icon icon-eye-off tw-mr-1"></i>Mark as unread</at-button>
{{--						<at-button type="text"><i class="icon icon-trash-2 tw-mr-1"></i>Delete</at-button>--}}
					</div>
				</div>
			</div>
		</account-notification-component>
	@endforeach
@endcomponent
