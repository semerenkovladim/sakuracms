<?php

namespace App\Http\Requests\Newsletter;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreNewsletterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create-newsletter');
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
            'body' => 'required|min:2|max:2000',
            'sending_at' => 'required|after_or_equal:' . Carbon::now(),
        ];
    }
}
