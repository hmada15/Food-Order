<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_create');
    }

    public function rules()
    {
        return [
            'client_id'         => [
                'required',
                'integer',
            ],
            'address_id'        => [
                'required',
                'integer',
                'exists:client_addresses,id'
            ],
            'products'          => [
                'required',
                'array'
            ],
            'products.*'       => [
                'required',
                'integer',
                'exists:products,id'
            ],
            'number_of_product'=> [
                'required',
                'array'
            ],
            'number_of_product.*'=> [
                'required',
                'integer',
                'min:1',
                'max:2147483647',
            ],
            'payment_method'    => [
                'required',
            ]
        ];
    }
}
