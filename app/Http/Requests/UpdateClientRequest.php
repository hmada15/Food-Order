<?php

namespace App\Http\Requests;

use App\Models\Client;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_edit');
    }

    public function rules()
    {
        return [
            'name'          => [
                'string',
                'required',
            ],
            'email'         => [
                'required',
                'unique:clients,email,' . request()->route('client')->id,
            ],
            'phone_number'  => [
                'string',
                'required',
            ],
            'date_of_birth' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
