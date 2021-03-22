<?php

namespace App\Http\Requests;

use App\Models\DeliveryFee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDeliveryFeeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('delivery_fee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:delivery_fees,id',
        ];
    }
}
