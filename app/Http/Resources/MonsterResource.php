<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MonsterResource extends JsonResource
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
            'id'   => $this->id,
            'name' => $this->name,
            'route' => $this->route,
            'image' => $this->animation,
            'dropCount' => $this->drops()->count(),
            'spawnCount' => $this->spawns()->count(),
            'properties' => $this->properties,
            'race' => $this->stats->race,
            'property' => $this->stats->element,
            'size' => $this->stats->size,
            'skillCount' => $this->skills()->count(),
        ];
    }
}
