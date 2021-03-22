<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_edit');
    }

    public function rules()
    {
        return [
            'name'          => [
                'string',
                'required',
            ],
            'tags.*'        => [
                'integer',
            ],
            'tags'          => [
                'array',
            ],
            'regular_price' => [
                'required',
            ],
            'sku'           => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'in_stock'      => [
                'required',
            ],
            'category_id'   => [
                'required',
                'integer',
            ],
        ];
    }
}
