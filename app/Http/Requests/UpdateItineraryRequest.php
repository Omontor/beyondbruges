<?php

namespace App\Http\Requests;

use App\Models\Itinerary;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateItineraryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('itinerary_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'landmarks.*' => [
                'integer',
            ],
            'landmarks' => [
                'array',
            ],
        ];
    }
}
