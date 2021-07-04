<?php

namespace App\Http\Requests\Backend\Category;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditCategoryRequest.
 */
class UpdateCategoryRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:100',
            ],
            'slug' => ['required', 'unique:categories,slug,'.$this->route('category')->id],
            'image' => ['sometimes', 'image', 'dimensions:ratio=275/290'],
            'icon' => ['sometimes', 'image', 'dimensions:max_width=30,max_height=30,ratio=1']
        ];
    }
}
