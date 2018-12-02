<?php /** @var \App\Server $server */ ?>

<div class="server microcard bg-white shadow-sm">

    <div class="image">
        <img src="{{ $server->banner_url }}" alt="{{ $server->name }}">
    </div>

    <div class="information d-flex flex-row p-3">
        <div class="details flex-grow-1">
            <h3 class="mb-0">{{ $server->name }}</h3>
            <p class="mb-0">Rates: 5/5/3 ~ 8/8/3</p>
        </div>
        <div class="buttons w-25 d-flex align-items-center justify-content-center">
            <a href="" class="btn btn btn-primary btn-sm" tabindex="0">Visit <i class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>

</div>