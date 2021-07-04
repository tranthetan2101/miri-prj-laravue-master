<?php

namespace App\Http\Requests\Backend\Coupon;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateCouponRequest.
 */
class UpdateCouponRequest extends FormRequest
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
            'code' => [
                'required',
                'string',
                'max:20',
                'unique:coupons,code,' . $this->route('coupon')->id . ',id'
            ],
            'name' => [
                'required',
                'string',
                'max:100'
            ],
            'period_start' => [
                'required',
                'date_format:Y-m-d H:i'
            ],
            'period_end' => [
                'required',
                'date_format:Y-m-d H:i',
                "after:period_start",
                "before:2038-01-01"
            ],
            'price' => ['required'],
            'used_num' => [
                'nullable',
                'numeric',
                'min:0'
            ]
        ];
    }
}
