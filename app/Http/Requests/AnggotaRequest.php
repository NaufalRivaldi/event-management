<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnggotaRequest extends FormRequest
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
            'photo' => 'nullable|file|mimes:jpeg,png,jpg,bmp|max:3072',
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->id)
            ],
            'password' => !$this->id ? 'required' : 'nullable',
            'father_name' => ['nullable', 'max: 255'],
            'mother_name' => ['nullable', 'max: 255'],
            'phone' => ['nullable', 'max: 255'],
            'age' => ['nullable', 'max: 255'],
            'hobby' => ['nullable', 'max: 255'],
            'address' => ['nullable'],
        ];
    }
}
