<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    /**
     * Since the scores are basically all the same, lets makes sure they
     * all use the same logic validation.
     *
     * @return string
     */
    public function validateScore()
    {
        return 'numeric|required|min:0|max:10';
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
            'donation_score' => $this->validateScore(),
            'update_score' => $this->validateScore(),
            'class_score' => $this->validateScore(),
            'item_score' => $this->validateScore(),
            'support_score' => $this->validateScore(),
            'hosting_score' => $this->validateScore(),
            'content_score' => $this->validateScore(),
            'event_score' => $this->validateScore(),
        ];
    }
}
