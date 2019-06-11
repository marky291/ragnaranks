<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConfigurationResource extends JsonResource
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
            'title' => $this->exp_title,
            'max_base_level' => $this->max_base_level ?? 0,
            'max_job_level' => $this->max_job_level ?? 0,
            'max_stats' => $this->max_stats ?? 0,
            'max_aspd' => $this->max_aspd ?? 0,
            'base_exp_rate' => $this->base_exp_rate ?? 0,
            'job_exp_rate' => $this->job_exp_rate ?? 0,
            'instant_cast_stat' => $this->instant_cast_stat ?? 0,
            'pk_mode' => $this->pk_mode ?? 0,
            'quest_exp_rate' => $this->quest_exp_rate ?? 0,
            'castrate_dex_scale' => $this->castrate_dex_scale ?? 0,
            'arrow_decrement' => $this->arrow_decrement ?? 0,
            'undead_detect_type' => $this->undead_detect_type ?? 0,
            'attribute_recover' => $this->attribute_recover ?? 0,
            'item_drop_common' => $this->item_drop_common ?? 0,
            'item_drop_equip' => $this->item_drop_equip ?? 0,
            'item_drop_card' => $this->item_drop_card ?? 0,
            'item_drop_common_mvp' => $this->item_drop_common_mvp ?? 0,
            'item_drop_equip_mvp' => $this->item_drop_equip_mvp ?? 0,
            'item_drop_card_mvp' => $this->item_drop_card_mvp ?? 0,
        ];
    }
}
