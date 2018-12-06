
    <?php /** @var \App\Server $server */ ?>


    <div class="card card-basic listing d-flex flex-row">
        <div class="detail flex-fill">
            <div class="top">
                <a href="">{{ $server->name }}</a>
            </div>
            <div class="bottom">
                <i class="fas fa-award"></i> {{ $message }}
            </div>
        </div>
        <div class="show-percentage d-flex align-items-center justify-content-center">
            {{ round($server->votes_trend, 0) }}%
        </div>
    </div>