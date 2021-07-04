<?php

namespace App\Http\Requests\Backend\Sale;

use App\Models\Sale;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

/**
 * Class UpdateProductRequest.
 */
class UpdateSaleRequest extends FormRequest
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
                'max:100'
            ],
            'period_start' => [
                'required',
                'date_format:Y-m-d H:i'
            ],
            'period_end' => [
                'required',
                'date_format:Y-m-d H:i',
                "after:period_start"
            ],
            'sale_amount' => [
                'required',
                'numeric',
                $this->type == Sale::PERCENT ? 'max:100' : ''
            ],
            'type' => [
                'required'
            ],
            'sale_items' => ['nullable','array']
        ];
    }
}
