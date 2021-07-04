<?php

namespace App\Http\Requests\Backend\Blog;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateBlogRequest.
 */
class UpdateBlogRequest extends FormRequest
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
                'max:255',
            ],
            'data' => [
                'required',
                'string',
            ],
            'description' => [
                'required',
                'string',
                'max:255'
            ],
            'slug' => ['required', 'unique:blogs,slug,'.$this->route('blog')->id],
            'image' => ['sometimes', 'image', 'dimensions:ratio=380/300']
        ];
    }
}
