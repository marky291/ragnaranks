<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'name' => $this->name ?? trans('profile.defaultName'),
            'slug' => $this->slug,
            'website' => $this->website,
            'accent' => $this->accent,
            'mode' => $this->mode,
            'screenshots' => $this->resource->relationLoaded('screenshots') ? $this->screenshots()->pluck('link')->toArray() : [],
            'ranking' => RankingResource::make($this->whenLoaded('ranking')),
            'background' => $this->background,
            'description' => $this->description ?? trans('profile.defaultMarkup'),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'config' => ConfigurationResource::make($this->whenLoaded('configuration')),
            'language' => $this->resource->relationLoaded('language') ? $this->language->name : 'english',
            'isEditor' => auth()->id(),
        ];
    }
}
