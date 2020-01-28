<?php

namespace App\Http\Resources;

use App\Listings\ListingHeartbeat;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ListingResource extends JsonResource
{
    /**
     * Indicates if the resource's collection keys should be preserved.
     *
     * @var bool
     */
    public $preserveKeys = false;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'website' => $this->website,
            'accent' => $this->accent,
            'mode' => $this->mode,
            'user_id' => $this->user_id,
            'review_score' => ceil($this->review_score),
            'screenshots' => $this->resource->relationLoaded('screenshots') ? $this->screenshots()->pluck('link')->toArray() : [],
            'ranking' => RankingResource::make($this->whenLoaded('ranking')),
            'background' => $this->background,
            'description' => $this->description,
            'tags' => $this->resource->relationLoaded('tags') ? $this->resource->tags->pluck('name')->toArray() : [],
            'config' => ConfigurationResource::make($this->whenLoaded('configuration')),
            'language' => $this->resource->relationLoaded('language') ? $this->language->name : 'english',
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')),
            'heartbeat' => ListingHeartbeatResource::make($this->whenLoaded('heartbeat')),
            'isEditor' => auth()->check() && user()->can('update', $this->resource),
            'canReview' => auth()->check() && user()->can('review', $this->resource),
        ];
    }
}
