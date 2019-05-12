<?php


namespace App\Listings;

use App\Tag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CardCacheContainer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function handle()
    {
        return cache()->rememberForever('cards', static function() {
            return app('listings')->map(static function(Listing $listing){
                return [
                    'rank' => $listing->rank,
                    'name' => $listing->name,
                    'description' => $listing->description,
                    'votes_count' => $listing->votes_count,
                    'clicks_count' => $listing->clicks_count,
                    'points' => $listing->points,
                    'expRateTitle' => $listing->expRateTitle,
                    'base_exp_rate' => $listing->configs['base_exp_rate'],
                    'job_exp_rate' => $listing->configs['job_exp_rate'],
                    'profile_url' => route('listing.show', $listing),
                    'banner_url' => $listing->banner_url,
                    'episode' => $listing->episode,
                    'created_at' => $listing->created_at->timestamp,
                    'tags' => $listing->tags->map(function(Tag $tag) {
                        return [
                            'name' => $tag->name,
                            'description' => $tag->description,
                            'tag' => $tag->tag
                        ];
                    })
                ];
            });
        });
    }
}