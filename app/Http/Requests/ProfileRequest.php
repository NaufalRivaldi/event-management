<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            'name' => ['required', 'max: 255'],
            'email' => [
                'required',
                'max: 255',
                Rule::unique('users', 'email')->ignore(Auth::user()->id)
            ],
            'father_name' => ['nullable', 'max: 255'],
            'mother_name' => ['nullable', 'max: 255'],
            'phone' => ['nullable', 'max: 255'],
            'age' => ['nullable', 'max: 255'],
            'hobby' => ['nullable', 'max: 255'],
            'address' => ['nullable'],
        ];
    }
}
