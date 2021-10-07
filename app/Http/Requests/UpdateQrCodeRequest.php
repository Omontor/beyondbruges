<?php

namespace App\Http\Requests;

use App\Models\QrCode;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateQrCodeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('qr_code_edit');
    }

    public function rules()
    {
        return [
            'transaction_total' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'issued_bryghia' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
