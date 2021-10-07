<?php

namespace App\Http\Requests;

use App\Models\Landmark;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLandmarkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('landmark_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'lat' => [
                'string',
                'required',
            ],
            'lng' => [
                'string',
                'required',
            ],
        ];
    }
}
