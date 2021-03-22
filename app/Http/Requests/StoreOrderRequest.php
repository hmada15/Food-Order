<?php

namespace App\Http\Requests;

use App\Models\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

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
            ],
            'product_id'        => [
                'required',
                'integer',
            ],
            'number_of_product' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'payment_method'    => [
                'required',
            ],
            'total_amount'      => [
                'required',
            ],
        ];
    }
}
