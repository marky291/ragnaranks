<?php /** @var \App\Listings\Listing $listing */ ?>

<div class="server-card item flex-fill shadow border rounded">
    <div class="server-card-head image rounded-top" style="background-image: url('{{$listing->banner_url}}')">
        {{-- Image --}}
    </div>
    <div class="server-card-head overlap d-flex">
        <div class="left-side d-flex w-75 flex-column align-items-start px-4 py-2 align-self-end">
            <h1 class="text-white font-weight-bold mb-0" style="font-size: 24px;">{{ $listing->name }}</h1>
            <ul class="tag-list tw-list-reset tw-flex tw-text-xs tw-text-green-light tw-mb-0">
                <?php /** @var \App\Tag $tag */ ?>
                @foreach ($listing->tags as $tag)
                    <li>#{{ $tag->name }}</li>
                @endforeach
            </ul>
        </div>
        <div class="right-side flex-fill d-flex justify-content-end pr-3" style="padding-bottom:12px;">
            <div class="d-flex flex-column justify-content-end mr-3" style="height:100%;">
                <h3 class="card-counter-title mb-0 font-weight-bold transparency">Votes</h3>
                <span class="card-counter font-weight-bold transparency">{{ $listing->votes_count }}</span>
            </div>
            <div class="d-flex flex-column justify-content-end mr-2" style="height:100%;">
                <h3 class="card-counter-title mb-0 font-weight-bold transparency">Clicks</h3>
                <span class="card-counter font-weight-bold transparency">{{ $listing->clicks_count }}</span>
            </div>
            <div class="d-flex flex-column justify-content-end" style="height:100%;">
                <img src="/img/flags/english.png" alt="EN">
            </div>
        </div>
    </div>
    <div class="server-card-body align-items-center px-4 py-3 d-flex">
        <div class="rating rounded-circle mr-3 d-flex font-weight-bold justify-content-center align-items-center" style="min-height:50px; min-width:50px;">
            {{ $listing->rank }}
        </div>
        <div class="flex-fill pr-3">
            <p class="font-weight-bold mb-0">{{ $listing->getExpRateTitleAttribute() }} ({{ $listing->configs['base_exp_rate'] }}x/{{ $listing->configs['job_exp_rate'] }}x)</p>
            <p class="text-muted">{{ $listing->description }}</p>
        </div>
        <button type="button" class="btn btn-blue btn-sm text-white" style="min-width: 60px;">View <i class="fas fa-long-arrow-alt-right"></i></button>
    </div>
</div>