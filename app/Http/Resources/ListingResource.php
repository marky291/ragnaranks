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
            'mode' => $this->mode,
            'ranking' => RankingResource::make($this->whenLoaded('ranking')),
            'background' => $this->background,
            'description' => $this->description,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'config' => ConfigurationResource::make($this->whenLoaded('configuration')),
            'language' => LanguageResource::make($this->whenLoaded('language')),
        ];
    }
}
