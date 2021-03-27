<?php

namespace App\Http\Requests\Promotion;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StorePromotionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create-promotion');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:newsletters|min:2|max:255',
            'before_product' => 'required|min:2|max:2000',
            'after_product' => 'required|min:2|max:2000',
            'sending_at' => 'required|after_or_equal:' . Carbon::now(),
        ];
    }
}
