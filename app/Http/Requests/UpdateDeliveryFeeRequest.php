<?php

namespace App\Http\Requests;

use App\Models\DeliveryFee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDeliveryFeeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('delivery_fee_edit');
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
