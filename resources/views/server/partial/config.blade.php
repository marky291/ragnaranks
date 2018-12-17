
<div class="config d-flex flex-row rounded">
    <div class="icon mr-3">
        <img src="{{ asset("images/config/{$type}-icon.png") }}" alt="" width="50" class="rounded-circle">
    </div>
    <div class="details d-flex flex-column justify-content-center">
        <span class="text-dark font-weight-bold">{{ $name }}</span>
        <p class="text-muted mb-0">{{ $value }}</p>
    </div>
</div>