<?php

namespace App\Http\Requests\Backend\Announcement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAnnouncementRequest extends FormRequest
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
            'message' => [
                'required',
                'string',
                'max:255'
            ],
            'starts_at' => [
                'required',
                'date_format:Y-m-d H:i',
                "before:2038-01-01"
            ],
            'ends_at' => [
                'required',
                'date_format:Y-m-d H:i',
                "after:starts_at",
                "before:2038-01-01"
            ]
        ];
    }

}
