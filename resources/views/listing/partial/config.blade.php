
<div class="config px-2 tw-py-2 tw-flex tw-justify-between flex-row tw-items-center">
    <div class="tw-flex tw-items-center">
        @if(isset($tooltip))
            <at-popover trigger="hover" class="tw-mr-2" content="{{ $tooltip }}" placement="right">
                <p><i class="icon icon-info"></i></p>
            </at-popover>
        @endif
        <p class="tw-text-gray-700 tw-font-semibold tw-text-xs tw-w-100">{{ $name }}</p>
    </div>
    <p class="tw-text-gray-800 tw-font-bold  mb-0">{{ $slot }}</p>
</div>
