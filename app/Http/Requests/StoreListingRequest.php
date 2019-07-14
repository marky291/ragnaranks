<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

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
            'config.max_base_level' => 'required|int|between:1,2147483648',
            'config.max_job_level' => 'required|int|between:1,2147483648',
            'config.max_aspd' => 'required|int|between:1,2147483648',
            'config.max_stats' => 'required|int|between:1,2147483648',
            'config.base_exp_rate' => 'required|int|between:1,2147483648',
            'config.job_exp_rate' => 'required|int|between:1,2147483648',
            'config.quest_exp_rate' => 'required|int|between:1,2147483648',
            'config.item_drop_common' => 'required|int|between:1,2147483648',
            'config.item_drop_equip' => 'required|int|between:1,2147483648',
            'config.item_drop_card' => 'required|int|between:1,2147483648',
            'config.item_drop_common_mvp' => 'required|int|between:1,2147483648',
            'config.item_drop_equip_mvp' => 'required|int|between:1,2147483648',
            'config.item_drop_card_mvp' => 'required|int|between:1,2147483648',
            'config.instant_cast_stat' => ['required', Rule::in(['0,1'])],
            'config.pk_mode' => ['required', Rule::in(['0,1'])],
            'config.arrow_decrement' => ['required', Rule::in(['0,1'])],
            'config.undead_detect_type' => ['required', Rule::in(['0,1'])],
            'config.attribute_recover' => ['required', Rule::in(['0,1'])],
        ];
    }
}
