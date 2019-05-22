<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'message' => 'string|required|min:200',
            'donation_score' => $this->scoreRules(),
            'update_score' => $this->scoreRules(),
            'class_score' => $this->scoreRules(),
            'item_score' => $this->scoreRules(),
            'support_score' => $this->scoreRules(),
            'hosting_score' => $this->scoreRules(),
            'content_score' => $this->scoreRules(),
            'event_score' => $this->scoreRules(),
        ];
    }

    /**
     * Since the scores are basically all the same, lets makes sure they
     * all use the same logic validation.
     *
     * @return string
     */
    public function scoreRules(): string
    {
        return 'numeric|required|min:0|max:10';
    }
}
