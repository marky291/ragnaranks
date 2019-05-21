<div class="item-group mt-3">
    <label class="tw-text-sm tw-font-semibold" for="{{ str_slug($title) }}">{{ $title }}</label>
    @if (isset($onChange))
        <at-input v-model="form.{{ $model }}" id="{{ str_slug($title) }}"></at-input>
    @else
        <at-input v-model="form.{{ $model }}" id="{{ str_slug($title) }}"></at-input>
    @endif
</div>