<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_attribute_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'product_id' => [
                'required',
                'integer',
            ],
            'attribute_name.*' => [
                'required',
                'string',
            ],
            'attribute_name' => [
                'required',
                'array',
            ],
            'value' => [
                'required',
                'array',
            ],
            'value.*' => [
                'required',
                'string',
            ],

        ];
    }
}
