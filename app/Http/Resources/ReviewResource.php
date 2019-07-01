<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'ip_address' => $this->ip_address,
            'message' => $this->message,
            'average_score' => $this->average_score,
            'donation_score' => $this->donation_score,
            'update_score' => $this->update_score,
            'class_score' => $this->class_score,
            'item_score' => $this->item_score,
            'support_score' => $this->support_score,
            'hosting_score' => $this->hosting_score,
            'content_score' => $this->content_score,
            'event_score' => $this->event_score,
            'created_at' => $this->created_at,
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
