<?php /** @var App\Server $server */?>

<div class="server card py-1 mb-2 membership-silver">
    <div class="statistics">
        <div class="ranking">
            <div class="text">
                Global Rank {{ $server->rank }}
            </div>
        </div>
    </div>
    <div class="inside rounded d-flex flex-column">
        <div class="header d-flex align-content-around">
            <h6 class="server-name text-grey-darkest">{{ $server->name }} (<small>{{ $server->exp_group }}</small>)</h6>
            <p class="server-votes">
                <span class="status">
                    <i class="fas fa-signal"></i>
                    Status: Online
                </span>

                {{ $server->votes_trend }}%
                <span class="in">
                    <i class="fas fa-arrow-circle-up"></i>
                    Votes: {{ $server->votes_count }}
                </span>

                {{ $server->clicks_trend }}%
                <span class="out">
                    <i class="fas fa-arrow-circle-down"></i>
                    Clicks: {{ $server->clicks_count }}
                </span>
            </p>
        </div>
        <div class="body d-flex flex-row flex-fill align-items-center">
            <div class="card-banner flex-fill">
                <img src="{!! $server->banner_url !!}" alt="Image Banner">
            </div>
            <div class="card-description flex-fill">
                <p>{{ $server->description }}</p>
            </div>
        </div>
        <div class="footer d-flex">
            <div class="tags flex-fill d-flex justify-content-start">
                <div class="tag {{ $server->cache('mode')->name }}">{{ $server->cache('mode')->name }}</div>
                <div class="tag roleplay">RolePlay</div>
                <div class="tag player-kill">PK Mode</div>
            </div>
            <div class="information flex-fill d-flex text-right justify-content-end rounded align-items-center">
                <div class="info flex-fill text-center"><b>Base Rate</b>: {{ $server->cache('config')->base_exp_rate }}x</div>
                <div class="info flex-fill text-center"><b>Episode</b>: {{ $server->episode }}</div>
                <div class="info flex-fill text-center"><b>Max Level</b>: {{ $server->cache('config')->max_base_level }}</div>
            </div>
        </div>
    </div>

</div>