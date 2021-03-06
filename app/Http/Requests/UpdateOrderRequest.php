<?php

namespace App\Http\Requests;

use App\Models\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
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
