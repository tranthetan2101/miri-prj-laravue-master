<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class OrderInfoRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email'],
            'phone' => ['required', 'digits:10'],
            'receive_phone_number'  => ['required', 'digits:10'],
            'addr_number' => ['required'],
            'addr_street' => ['required'],
            'city_id' => ['required'],
            'district_id' => ['required'],
            'ward_id' => ['required'],
            'receive-info' => [],
            'rule' => ['required'],
        ];
    }

    public function parameters()
    {

        return [
            'name'                  => $this->input('name', ''),
            'email'                 => $this->input('email', ''),
            'phone_number'          => $this->input('phone', ''),
            'receive_phone_number'  => $this->input('receive_phone_number', ''),
            'addr_number'           => $this->input('addr_number', ''),
            'addr_street'           => $this->input('addr_street', ''),
            'city_id'               => $this->input('city_id', ''),
            'district_id'           => $this->input('district_id', ''),
            'ward_id'               => $this->input('ward_id', ''),
            'receive-info'          => $this->input('receive-info', ''),
            'rule'                  => $this->input('rule', ''),
        ];
    }
}
