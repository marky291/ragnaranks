<div class="col mr-2 d-flex align-items-center rounded overflow-hidden background-green">
    <div class="rating-block d-flex flex-row p-3 h-100">
        <div class="d-flex">
            <div class="w-75">
                <h4 class="text-light">{{ $name }}</h4>
                <p class="text-light mb-0">{{ $description }}</p>
            </div>
            <span class="w-25 score text-transparent">
                {{ rand(1, 10) }}
            </span>
        </div>
    </div>
</div>