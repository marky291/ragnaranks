
<div class="config px-2 py-2 d-flex flex-row tw-items-center">
    @if(isset($tooltip))
        <at-popover trigger="hover" class="tw-mr-2" content="{{ $tooltip }}" placement="right">
            <p><i class="icon icon-info"></i></p>
        </at-popover>
    @endif
    <p class="text-dark font-weight-bold flex-fill">{{ $name }}</p>
    <p class="text-muted mb-0">{{ $slot }}</p>
</div>