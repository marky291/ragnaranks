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
            'votes' => $this->votes()->count(),
            'clicks' => $this->clicks()->count(),
            'rank' => $this->rank,
            'website' => $this->website,
            'background' => $this->background,
            'description' => $this->description,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'language' => $this->whenLoaded('language'),
        ];
    }
}
