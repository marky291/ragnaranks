
<?php /** @var \App\Server $server */ ?>

<div class="ranking">
    <div class="server-header">
        <div class="server-rank">
            {{ $server->rank }}.<span>Global Rank</span>
        </div>
        <div class="server-image">
            <img src="{{ $server->banner_url }}" alt="">
        </div>
        <div class="server-statistics appear">
            <div class="server-clicks">
                <small><i class="fas fa-long-arrow-alt-down color-danger"></i> Clicks</small>
                <div class="countTo" data-count="{{ $server->clicks_count }}">{{ $server->clicks_count }}</div>
            </div>
            <div class="server-votes appear">
                <small><i class="fas fa-long-arrow-alt-up color-success"></i> Votes</small>
                <div class="countTo" data-count="{{ $server->votes_count }}">{{ $server->votes_count }}</div>
            </div>
        </div>
    </div>
    <div class="server-body">
        <div class="server-name">
            <h3><a href="">{{ $server->name }}</a></h3>
            <small class="subheading">Online Since: {{ $server->created_at->diffForHumans() }}</small>
            <div class="server-languages">
                <img src="img/English.gif" alt="">
            </div>
        </div>
        <p>{{ $server->description }}</p>
        <div class="server-basic-info">
            <ul>
                <li><strong>Rates:</strong>{{ $server->cache('config')->base_exp_rate }}</li>
                <li><strong>Episode:</strong>{{ $server->episode }}</li>
                <li><strong>Max Level:</strong>{{ $server->cache('config')->max_base_level }}/{{ $server->cache('config')->max_job_level }}</li>
                <li><strong>Daily Online:</strong>{{ rand(1, 2000) }}</li>
            </ul>
        </div>
    </div>
    <div class="server-footer">
        <span>Server Tags:</span>
        <?php /** @var \App\Tag $tag */ ?>
        @foreach ($server->tags() as $tag)
            {{--<a href="" class="badge badge-{{ $tag->name }}" alt="{{ $tag->description }}">{{ $tag->name }}</a>ef="" class="badge badge-{{ $tag->name }}" alt="{{ $tag->description }}">{{ $tag->name }}</a>--}}
        @endforeach

        <div class="server-social">
            <iframe src="https://www.facebook.com/plugins/like.php?href=https://facebook.com/EADevOfficial%2F&width=124&layout=button_count&action=like&size=small&show_faces=false&share=true&height=46&appId=508842139484989" width="124" height="46" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
        </div>
    </div>
</div>