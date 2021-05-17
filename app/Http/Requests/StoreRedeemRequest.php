<?php

namespace App\Http\Requests;

use App\Models\Redeem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRedeemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('redeem_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'prize_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
