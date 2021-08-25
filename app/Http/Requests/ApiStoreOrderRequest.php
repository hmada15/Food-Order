<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ApiStoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'address_id'        => [
                'required',
                'integer',
                'exists:client_addresses,id'
            ],
            'products'          => [
                'required',
                'json'
            ],
            'products.*'       => [
                'required',
                'integer',
                'exists:products,id'
            ],
            'number_of_product'=> [
                'required',
                'json'
            ],
            'number_of_product.*'=> [
                'required',
                'integer',
                'min:1',
                'max:2147483647',
            ],
            'payment_method'    => [
                'required',
                'in:option-cash,option-app-wallet,option-card,option-digital-wallet'
            ],
            'status'    => [
                'required',
                'in:option-pending,option-processing,option-completed,option-cancelled,option-refunded,'
            ],
            "delivery_fee_id" => [
                'nullable',
                'integer',
                'exists:delivery_fees,id'
            ],
            "tax_id" => [
                'nullable',
                'integer',
                'exists:tax_values,id'
            ],

        ];
    }
}
