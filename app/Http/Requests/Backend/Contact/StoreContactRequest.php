<?php

namespace App\Http\Requests\Backend\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreContactRequest.
 */
class StoreContactRequest extends FormRequest
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
            'address' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => ['required', 'email'],
            'phone_number' => ['required','string','max:18'],
            'link' => ['required','url'],
            'image' => ['required', 'image'],
            'open_time' => ['required','date_format:H:i'],
            'close_time' => ['required','date_format:H:i']
        ];
    }
}
