<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'accent' => Rule::in(config('filter.accents')),
            'language' => Rule::in(config('filter.languages')),
            'background' => 'active_url|required|min:3',
            'website' => 'required|min:3|active_url',
            'mode' => Rule::in(config('filter.modes')),
            'tags.*' => Rule::in(config('filter.tags')),
            'screenshots.*' => 'active_url|string',
            'description' => 'required|string|min:100',
            'max_base_level' => 'required|int|between:1,2147483648',
            'max_job_level' => 'required|int|between:1,2147483648',
            'max_aspd' => 'required|int|between:1,2147483648',
            'max_stats' => 'required|int|between:1,2147483648',
            'base_exp_rate' => 'required|int|between:1,2147483648',
            'job_exp_rate' => 'required|int|between:1,2147483648',
            'quest_exp_rate' => 'required|int|between:1,2147483648',
            'item_drop_common' => 'required|int|between:1,2147483648',
            'item_drop_equip' => 'required|int|between:1,2147483648',
            'item_drop_card' => 'required|int|between:1,2147483648',
            'item_drop_common_mvp' => 'required|int|between:1,2147483648',
            'item_drop_equip_mvp' => 'required|int|between:1,2147483648',
            'item_drop_card_mvp' => 'required|int|between:1,2147483648',
            'instant_cast_stat' => 'required|boolean',
            'pk_mode' => 'required|boolean',
            'arrow_decrement' => 'required|boolean',
            'undead_detect_type' => 'required|boolean',
            'attribute_recover' => 'required|boolean',
        ];
    }
}
