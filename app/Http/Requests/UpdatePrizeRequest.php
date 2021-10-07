<?php

namespace App\Http\Requests;

use App\Models\Prize;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePrizeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('prize_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'cost' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'quantity' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
