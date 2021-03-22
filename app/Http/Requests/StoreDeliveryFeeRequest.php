<?php

namespace App\Http\Requests;

use App\Models\DeliveryFee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDeliveryFeeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('delivery_fee_create');
    }

    public function rules()
    {
        return [
            'name'   => [
                'string',
                'required',
            ],
            'amount' => [
                'required',
            ],
        ];
    }
}
