<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'website' => $this->website,
            'ranking' => RankingResource::make($this->whenLoaded('ranking')),
            'background' => $this->background,
            'description' => $this->description,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'language' => $this->language->name,
        ];
    }
}
