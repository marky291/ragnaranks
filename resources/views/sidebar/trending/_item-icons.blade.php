
@foreach ($viewable->unique() as $view)
    <a href="{{ route('database.item', $view->viewable) }}">
        <div class="tw-col-span-1 tw-flex tw-flex-col tw-items-center tw-text-center tw-justify-center hover:tw-bg-gray-100">
                <img src="{{ $view->viewable->image }}" alt="{{ $view->viewable->name }}" style="max-height:45px;">
                <p>{{ $view->viewable->name }}</p>
        </div>
    </a>
@endforeach