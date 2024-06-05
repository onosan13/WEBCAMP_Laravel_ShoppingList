<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'name' => ['required', 'max:254'],
            'email' => ['required', 'email','max:254'],
            'password' => ['required','max:72'],
            'password_c' => ['required', 'max:72'],
        ];
    }
}
