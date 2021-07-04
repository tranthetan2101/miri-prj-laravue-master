<?php

namespace App\Http\Requests\Backend\Combo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
/**
 * Class StoreComboRequest.
 */
class StoreComboRequest extends FormRequest
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

    public function validationData()
    {
        $data = parent::validationData();

        // Modify the data to validate.
        // Modify the data to validate.
        return array_merge($data, [
            'price' => str_replace('.', '', $data['price']),
            'discount_price' => str_replace('.', '', $data['discount_price'])
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $dimensions = '600x235';
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'image' => [
                'required',
                function ($attribute, $value, $fail) use ($dimensions) {
                        if (Str::startsWith($value, config('filesystems.disks.public.url'))) {
                            $image_path = str_replace(config('filesystems.disks.public.url'), config('filesystems.disks.public.root'), $value);
                        } else {
                            $image_path = config('filesystems.disks.public.root').'/'.$value;
                        }
                        list($width, $height) = getimagesize($image_path);
                        if ($width.'x'.$height != $dimensions) {
                            $fail($attribute.' phải có kích thước '.$dimensions);
                        }
                },
            ],
            'sku' => [
                'required',
                'string',
                Rule::unique('products'),
                'max:50',
            ],
            'price' => [
                'required',
                'numeric',
            ],
            'description' => [
                'required',
                'string',
            ],
            'slug' => ['required', Rule::unique('combos')],
//            'products' => ['required','array'],
            'product_id' => [
                'required',
                Rule::exists('products', 'id')->where(function ($query) {
                    $query->whereNotNull('gift_set');
                }),
            ],
            'discount_price' => [
                'nullable',
                'numeric',
                'lte:price'
            ],
        ];
    }
    public function messages()
    {
        return [
            'discount_price.lte' => __('Discount price must be less than or equal price')
        ];
    }

}
