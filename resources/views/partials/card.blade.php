
<?php /** @var \App\Server $server */ ?>

<div class="server card mb-3">

    <div class="overview d-flex">
        <div class="rank d-flex flex-column mr-2">
            <div class="score flex-fill px-2 d-flex align-items-center">{{ rand(00.00, 99.99) }}.00</div>
            <div class="title text-center">Score</div>
        </div>
        <div class="banner">
            <img src="{{ $server->banner_url }}" alt="">
        </div>
        <div class="interactions d-flex mr-2 flex-fill justify-content-around">
            <div class="clicks border-right text-right flex-fill px-3">
                <i class="fas fa-long-arrow-alt-down text-success"></i> Clicks
                <div class="counter">{{ $server->clicks_count }}</div>
            </div>
            <div class="votes text-left flex-fill px-3">
                <i class="fas fa-long-arrow-alt-up text-danger"></i> Votes
                <div class="counter">{{ $server->votes_count }}</div>
            </div>
        </div>
    </div>

    <div class="detailed">
        <div class="d-flex mt-3">
            <div class="flex-1 flex-grow-1">
                <div class="name"><h3>{{ $server->name }}</h3></div>
                <div class="created subheading"><small>Online Since: {{ $server->created_at->format('dS F Y') }}</small></div>
            </div>
            <div class="w-25 align-self-end text-right">
                <div class="language">
                    <span class="mr-2">English Server</span> <img src="img/English.gif" alt="english language">
                </div>
            </div>
        </div>

        {{-- Another name for tags etc.. what people might look for --}}
        <div class="flares d-flex pt-1">

            <div class="tags flex-grow-1 flex-1 d-flex">
                <?php /** @var \App\Tag $tag */ ?>
                <div class="flare mr-2 pre-renewal">Pre-Renewal</div>
                <div class="flare roleplay">Role Playing</div>
                @foreach ($server->tags() as $tag)
                    {{--<a href="" class="badge badge-{{ $tag->name }}" alt="{{ $tag->description }}">{{ $tag->name }}</a>ef="" class="badge badge-{{ $tag->name }}" alt="{{ $tag->description }}">{{ $tag->name }}</a>--}}
                @endforeach
            </div>

            {{--<div class="social w-25">--}}
                {{--<iframe src="https://www.facebook.com/plugins/like.php?href=https://facebook.com/EADevOfficial%2F&width=124&layout=button_count&action=like&size=small&show_faces=false&share=true&height=46&appId=508842139484989" width="124" height="46" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>--}}
            {{--</div>--}}

        </div>

        <div class="description my-3 text-justify">
            <p>{{ fake()->text(600) }}</p>
        </div>
    </div>

    {{-- Quick view information on the server --}}
    <div class="glance d-flex mb-2">
        <ul class="list-unstyled d-flex flex-1 mb-0 align-items-center">
            <li class="mr-3"><span class="font-weight-bold ">Rates:</span> {{ $server->config->base_exp_rate }}/{{ $server->config->job_exp_rate }}</li>
            <li class="mr-3"><span class="font-weight-bold">Episode:</span> {{ $server->episode }}</li>
            <li class="mr-3"><span class="font-weight-bold">Max Level:</span> {{ $server->config->max_base_level }}</li>
            <li class="mr-3"><span class="font-weight-bold">Daily Online:</span> {{ rand(0, 499) }}</li>
        </ul>

        <div class="buttons d-flex justify-content-end flex-fill">
            <a href="" class="btn btn btn-outline-primary mr-2 btn-sm" tabindex="0">Expand
                    <img
                        src="{{ asset('img/icons/magnifyer.gif') }}"
                        alt="View more information on this server" height="16" width="16"
                    >
            </a>
            <a href="" class="btn btn btn-primary btn-sm" tabindex="0">Warp
                    <img src="{{ asset('img/icons/butterfly_wing.gif') }}"
                        alt="Visit the servers webiste for information" height="16" width="16"
                    >
            </a>
        </div>
    </div>

</div>