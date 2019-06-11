<?php

namespace App\Http\Resources;

use App\Listings\ListingConfiguration;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
            'ranking' => RankingResource::make($this->whenLoaded('ranking')),
            'background' => $this->background,
            'description' => $this->description,
            'tags' => $this->tags()->pluck('name')->toArray(),
            'config' => ConfigurationResource::make($this->whenLoaded('configuration')),
            'language' => LanguageResource::make($this->whenLoaded('language')),
            'isEditor' => \auth()->id(),
        ];
    }
}
