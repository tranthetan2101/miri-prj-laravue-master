<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAddrRequest extends FormRequest
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
            'id'            => $this->input('id', ''),
            'user_id'       => $this->input('user_id', ''),
            'name'          => $this->input('name', ''),
            'phone_number'  => $this->input('phone_number', ''),
            'company_name'  => $this->input('company_name', ''),
            'addr_number'   => $this->input('addr_number', ''),
            'addr_street'   => $this->input('addr_street', ''),
            'city_id'       => $this->input('city_id', ''),
            'district_id'   => $this->input('district_id', ''),
            'ward_id'       => $this->input('ward_id', ''),
        ];
    }
}
