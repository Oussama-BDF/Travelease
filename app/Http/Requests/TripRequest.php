<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
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
            'destination' => 'required|max:100',
            'start_at' => 'required',
            'end_at' => 'required',
            'price' => 'required|numeric|min:0.01|max:9999.99',
            'accommodation' => 'required|max:100',
            'transport_id' => 'required',
        ];
    }
}
