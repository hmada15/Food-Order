<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiStoreClientAddressRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'area'             => [
                'string',
                'nullable',
            ],
            'street_name'      => [
                'string',
                'nullable',
            ],
            'building_name'    => [
                'string',
                'nullable',
            ],
            'floor_number'     => [
                'string',
                'nullable',
            ],
            'apartment_number' => [
                'string',
                'nullable',
            ],
            'landmark'         => [
                'string',
                'nullable',
            ],
        ];
    }
}
