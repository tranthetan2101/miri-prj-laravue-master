<?php

namespace App\Http\Requests\Backend\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreCategoryRequest.
 */
class StoreCategoryRequest extends FormRequest
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
            'slug' => ['required', Rule::unique('categories')],
            'image' => ['required','image', 'dimensions:ratio=275/290'],
            'icon' => ['required', 'image', 'dimensions:max_width=30,max_height=30,ratio=1']
        ];
    }
}
