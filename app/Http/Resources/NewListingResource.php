<?php

namespace App\Http\Resources;

use App\Listings\ListingConfiguration;
use Illuminate\Http\Resources\Json\JsonResource;

class NewListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $preset = array_random(config('filter.presets'));

        return [
            'id' => $this->id,
            'name' => trans('profile.defaultName'),
            'slug' => $this->slug,
            'website' => $this->website,
            'accent' => $preset['accent'],
            'mode' => 'renewal',
            'review_score' => $this->review_score,
            'screenshots' => [],
            'ranking' => RankingResource::make($this->whenLoaded('ranking')),
            'background' => $preset['card'],
            'description' => trans('profile.defaultMarkup'),
            'tags' => [],
            'config' => ConfigurationResource::make(new ListingConfiguration),
            'language' => 'english',
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')),
            'isEditor' => auth()->id(),
        ];
    }
}
