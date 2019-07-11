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
            'max_base_level' => $this->max_base_level,
            'max_job_level' => $this->max_job_level,
            'max_stats' => $this->max_stats,
            'max_aspd' => $this->max_aspd,
            'base_exp_rate' => $this->base_exp_rate,
            'job_exp_rate' => $this->job_exp_rate,
            'instant_cast_stat' => $this->instant_cast_stat,
            'pk_mode' => $this->pk_mode ?? 'No',
            'quest_exp_rate' => $this->quest_exp_rate,
            'castrate_dex_scale' => $this->castrate_dex_scale,
            'arrow_decrement' => $this->arrow_decrement,
            'undead_detect_type' => $this->undead_detect_type,
            'attribute_recover' => $this->attribute_recover,
            'item_drop_common' => $this->item_drop_common,
            'item_drop_equip' => $this->item_drop_equip,
            'item_drop_card' => $this->item_drop_card,
            'item_drop_common_mvp' => $this->item_drop_common_mvp,
            'item_drop_equip_mvp' => $this->item_drop_equip_mvp,
            'item_drop_card_mvp' => $this->item_drop_card_mvp,
        ];
    }
}
