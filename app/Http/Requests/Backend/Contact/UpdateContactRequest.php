<?php

namespace App\Http\Requests\Backend\Contact;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateContactRequest.
 */
class UpdateContactRequest extends FormRequest
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
            'image' => ['sometimes', 'image'],
            'open_time' => ['required','date_format:H:i'],
            'close_time' => ['required','date_format:H:i']
        ];
    }
}
