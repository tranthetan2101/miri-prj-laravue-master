<?php

namespace App\Http\Requests\Backend\CoupleProduct;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateCoupleProductRequest.
 */
class UpdateCoupleProductRequest extends FormRequest
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
            'product1_id' => [
                'required',
                'exists:products,id'
            ],
            'product1_image' => ['nullable', 'image', 'dimensions:width=485,height=515'],
            'product2_id' => [
                'required',
                'exists:products,id',
                'unique:couple_products,product2_id,' . $this->route('couple_product')->id . ',id,product1_id,' . $this->product1_id
            ],
            'product2_image' => ['nullable', 'image', 'dimensions:width=485,height=515'],
        ];
    }
}
