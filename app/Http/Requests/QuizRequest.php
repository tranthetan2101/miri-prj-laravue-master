<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
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
            //
        ];
    }

    /**
     * Get Parameters
     *
     * @return array
     */
    public function parameters()
    {
        return [
            'name'         => $this->input('name', ''),
            'email'        => $this->input('email', ''),
            'phone_number' => $this->input('phone_number', ''),
            'skin_type'    => $this->input('skin_type', ''),
            'skin_problem' => $this->input('skin_problem', ''),
            'note'         => $this->input('note', ''),
        ];
    }
}
