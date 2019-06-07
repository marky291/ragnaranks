<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RankingResource extends JsonResource
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
            'rank' => $this->rank,
            'points' => $this->points,
            'votes' => $this->votes,
            'clicks' => $this->clicks,
        ];
    }
}
