<div class="item-group mt-3">
    <label class="tw-text-sm tw-font-semibold" for="{{ str_slug($title) }}">{{ $title }}</label>
    @if (isset($onChange))
        <at-input @change="{{ $onChange }}" v-model="form.{{ $model }}" :status="form.errors.has('{{$model}}') ? 'error' : ''" id="{{ str_slug($title) }}"></at-input>
    @else
        <at-input v-model="form.{{ $model }}" :status="form.errors.has('{{$model}}') ? 'error' : ''" id="{{ str_slug($title) }}"></at-input>
    @endif
    @if (isset($describe))
        <p class="tw-mt-2 tw-text-grey-darker">{{ $describe }}</p>
    @endif
    <has-error :form="form" field="{{$model}}"></has-error>
</div>