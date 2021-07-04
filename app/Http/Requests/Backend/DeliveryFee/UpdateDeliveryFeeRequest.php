<?php

namespace App\Http\Requests\Backend\DeliveryFee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateDeliveryFeeRequest.
 */
class UpdateDeliveryFeeRequest extends FormRequest
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
        $city_id = $this->city_id;
        $district_id = $this->district_id;
        return [
            'city_id' => [
                'required',
                'exists:cities,id'
            ],
            'district_id' => [
                'required',
                Rule::exists('districts', 'id')->where(function ($query) use ($city_id) {
                    $query->where('city_id', $city_id);
                }),
            ],
            'ward_id' => [
                'required',
                Rule::exists('wards', 'id')->where(function ($query) use ($district_id) {
                    $query->where('district_id', $district_id);
                }),
                'unique:delivery_fees,ward_id,' . $this->route('delivery_fee')->id . ',id,district_id,' . $this->district_id . ',city_id,' . $this->city_id
            ],
            'fee' => ['required'],
        ];
    }
}
