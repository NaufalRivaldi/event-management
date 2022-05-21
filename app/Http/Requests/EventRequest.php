<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'nullable',
            'location' => 'nullable',
            'is_register' => 'nullable',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }
}
