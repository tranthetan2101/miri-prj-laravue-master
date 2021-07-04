<?php

namespace App\Http\Requests\Backend\Product;

use App\Rules\EmptyWith;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Class UpdateProductRequest.
 */
class UpdateProductRequest extends FormRequest
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
        return array_merge($data, [
            'price' => str_replace('.', '', $data['price']),
            'discount_price' => str_replace('.', '', $data['discount_price'])
        ]);
    }

//    protected function prepareForValidation(): void
//    {
//        $this->merge([
//            'discount_price' => str_replace('.','',$this->discount_price),
//            'price' => str_replace('.','',$this->price),
//        ]);
//    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $dimensions = $this->gift_set ? '590x465' : '275x395';
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
            'sku' => [
                'required',
                'string',
                'max:50',
            ],
            'price' => [
                'required',
                'numeric',
            ],
            'capacity' => [
                'nullable'
            ],
            'origin' => [
                'nullable'
            ],
            'tag_sale' => [
                'nullable'
            ],
            'discount_price' => [
                'nullable',
                'numeric',
                'lte:price'
            ],
            'description' => [
                'required',
                'string',
            ],
            'description_2' => [
                'required',
                'string',
            ],
            'description_3' => [
                'required',
                'string',
            ],

            'slug' => ['required', 'unique:products,slug,'.$this->route('product')->id],
            'images' => [
                'required',
                function ($attribute, $values, $fail) use ($dimensions) {
                    $images = explode(',', $values);
                    foreach ($images as $k => $image) {
                        if (Str::startsWith($image, config('filesystems.disks.public.url'))) {
                            $image_path = str_replace(config('filesystems.disks.public.url'), config('filesystems.disks.public.root'), $image);
                        } else {
                            $image_path = config('filesystems.disks.public.root').'/'.$image;
                        }
                        Log::info('Image Path: '.$image_path);
                        list($width, $height) = getimagesize($image_path);
                        if ($width.'x'.$height != $dimensions) {
                            $fail($attribute.' phải có kích thước '.$dimensions);
                        }
                    }
                },
            ],
            'tag_best' => [new EmptyWith($this->tag_recommend)],
            'gift_set' => ['nullable','array'],
            'recommend' => ['nullable','array'],
            'bonus' => ['nullable','array']
        ];
    }
}
