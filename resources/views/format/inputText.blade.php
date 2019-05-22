<div class="item-group mt-3">
    <label class="tw-text-sm tw-font-semibold" for="{{ str_slug($title) }}">{{ $title }}</label>
    @if (isset($onChange))
        <at-input v-model="form.{{ $model }}" :status="form.errors.has('{{$model}}') ? 'error' : ''" id="{{ str_slug($title) }}"></at-input>
    @else
        <at-input v-model="form.{{ $model }}" :status="form.errors.has('{{$model}}') ? 'error' : ''" id="{{ str_slug($title) }}"></at-input>
    @endif
    <has-error :form="form" field="{{$model}}"></has-error>
</div>