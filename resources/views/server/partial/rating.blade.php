<?php $rating = rand(1, 10); ?>




<div class="col mr-2 d-flex align-items-center rounded overflow-hidden score-is-{{ $rating >= 7 ? "good" : ($rating >= 4 ? "ok" : "bad") }}">
    <div class="rating-block d-flex flex-row p-3 h-100">
        <div class="d-flex">
            <div class="w-75">
                <h4 class="text-light">{{ $name }}</h4>
                <p class="text-light mb-0">{{ $description }}</p>
            </div>
            <span class="score position-absolute text-transparent h-100">
                {{ $rating }}
            </span>
        </div>
    </div>
</div>