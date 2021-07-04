<?php

namespace App\Http\Requests\Backend\CoupleProduct;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreCoupleProductRequest.
 */
class StoreCoupleProductRequest extends FormRequest
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
        $product1_id = $this->product1_id;
        return [
            'product1_id' => [
                'required',
                'exists:products,id'
            ],
            'product1_image' => ['nullable', 'image', 'dimensions:width=485,height=515'],
            'product2_id' => [
                'required',
                'exists:products,id',
                Rule::unique('couple_products')->where(function ($query) use($product1_id) {
                    return $query->where('product1_id', $product1_id);
                })
            ],
            'product2_image' => ['nullable', 'image', 'dimensions:width=485,height=515'],
        ];
    }
}
