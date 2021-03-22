<?php

namespace App\Http\Requests;

use App\Models\TaxValue;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTaxValueRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('tax_value_edit');
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
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
