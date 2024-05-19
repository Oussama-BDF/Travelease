<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripRequest extends FormRequest
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
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'price' => 'required|numeric|max:9999.99',
            'accommodation' => 'required|max:100',
            'transport_id' => 'required',
            'description' => 'nullable|string',
            'activity_price.*' => 'required|numeric|max:9999.99',
            'activity_name.*' => 'required',
            'image1' => 'required|image|mimes:jpg,jpeg,png|max:5000',
            'image2' => 'image|mimes:jpg,jpeg,png|max:5000',
            'image3' => 'image|mimes:jpg,jpeg,png|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'activity_name.*.required' => 'The name field is required.',
            'activity_price.*.required' => 'The price field is required.',
            'activity_price.*.numeric' => 'The activity price field must be a number.',
            'activity_price.*.max' => 'The activity price field must not be greater than 9999.99.',
            'transport_id.required' => 'The transport field is required.',
            'image*.required' => 'The first image field is required.',
            'image*.mimes' => 'The image field must be a file of type: jpg, jpeg, png.',
            'image*.image' => 'The image field must be an image.',
        ];
    }
}
