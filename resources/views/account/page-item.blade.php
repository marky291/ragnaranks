<section id="{{ $title }}" class="content-block">
    <div class="container tw-bg-white tw-rounded shadow-sm py-4 px-3">
        <h3 class="heading mb-4 tw-font-bold tw-text-lg heading-underline">{{ $title }}</h3>
        <div class="row no-gutters">
            {{ $slot }}
        </div>
    </div>
</section>