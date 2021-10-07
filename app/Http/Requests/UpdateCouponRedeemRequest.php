<?php

namespace App\Http\Requests;

use App\Models\CouponRedeem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCouponRedeemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('coupon_redeem_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'coupon_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
