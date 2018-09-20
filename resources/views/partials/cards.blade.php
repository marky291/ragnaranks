<?php /** @var App\Server $server */?>

@php($membership_type = $server->owner->isGoldMember() ? 'gold' : 'silver')

<div class="server card py-1 mb-2 membership-{{ $membership_type }}">
    <div class="statistics">
        <div class="ranking">
            <div class="text">
                Rank {{ $server->id }}
            </div>
        </div>
    </div>
    <div class="inside rounded d-flex flex-column">
        <div class="header d-flex align-content-around">
            <h6 class="server-name text-grey-darkest">{{ $server->name }}</h6>
            <p class="server-votes">
                <span class="status">
                    <i class="fas fa-signal"></i>
                    Status: Online
                </span>
                &emsp;&emsp;
                <span class="in">
                    <i class="fas fa-arrow-circle-up"></i>
                    Votes: {{ $server->votes()->count() }}
                </span>
                &emsp;&emsp;
                <span class="out">
                    <i class="fas fa-arrow-circle-down"></i>
                    Clicks: {{ $server->clicks()->count() }}
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
                <div class="tag pre-renewal">Pre-Re</div>
                <div class="tag renewal">Renewel</div>
                <div class="tag roleplay">RolePlay</div>
                <div class="tag player-kill">PK Mode</div>
            </div>
            <div class="information flex-fill d-flex text-right justify-content-end rounded align-items-center">
                <div class="info flex-fill text-center"><b>Rates</b>: 3k/3k</div>
                <div class="info flex-fill text-center"><b>Episode</b>: 15.2</div>
                <div class="info flex-fill text-center"><b>Max Level</b>: 255</div>
            </div>
        </div>
    </div>

</div>