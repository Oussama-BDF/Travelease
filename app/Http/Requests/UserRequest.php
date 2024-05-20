<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'min:8', 'max:60', 'confirmed'],
            'phone_number' => ['nullable', 'string', 'max:25','regex:/^(\+212|0)([ \-]?[0-9]){9}$/'],
            'address' => ['nullable', 'string', 'max:100'],
            'profile_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:5000'],
        ];
    }
}
