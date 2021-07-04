<?php

namespace App\Http\Requests\Backend\Element;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreElementRequest.
 */
class StoreElementRequest extends FormRequest
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
        $dimensions = '275x275';
        return [
            'image' => ['required', 'string', function ($attribute, $value, $fail) use ($dimensions) {
                list($width, $height) = getimagesize(str_replace(config('filesystems.disks.public.url'), config('filesystems.disks.public.root'), $value));
                if ($width.'x'.$height != $dimensions) {
                    $fail($attribute.' phải có kích thước '.$dimensions);
                }
            },],
            'name' => ['required','string','max:255','unique:elements'],
            'description' => [
                'required',
                'string'
            ],
        ];
    }
}
