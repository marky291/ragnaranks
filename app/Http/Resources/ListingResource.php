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
            'accent' => $this->accent,
            'background' => $this->background,
            'description' => $this->description,
            'website' => $this->website,
            'mode' => new ModeResource($this->whenLoaded('mode')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'rank' => $this->rank,
            'votes' => 999,
            'clicks' => 999,
        ];
    }
}
