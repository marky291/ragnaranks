
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
        <div class="d-flex stat align-items-center justify-content-center">
            @if ($server->$column > 0)
                <span class="text-green">{{ round($server->$column, 0) }}%</span> <i class="ml-2 fas fa-angle-double-up text-success"></i>
            @else
                <span class="text-red">{{ round($server->$column, 0) }}%</span> <i class="ml-2 fas fa-angle-double-down text-danger"></i>
            @endif
        </div>
    </div>