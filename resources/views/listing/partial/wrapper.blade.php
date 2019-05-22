<section id="{{ $view }}" class="content-block mt-4">
    <div class="container px-5 py-4">
        <h3 class="heading tw-font-bold mb-4 text-dark heading-underline">{{ $heading }}</h3>
        <div class="row no-gutters">
            {{ $slot }}
        </div>
    </div>
</section>