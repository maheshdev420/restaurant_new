<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow the request or add custom logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'phone'          => 'required|string|max:15',
            'postcode'       => 'required|string|max:10',
            'address'        => 'required|string|max:255',
            'street_name'    => 'required|string|max:255',
            'address_second' => 'nullable|string|max:255', // Optional field
            'city'           => 'required|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'first_name.string'   => 'First name must be a string.',
            'last_name.required'  => 'Last name is required.',
            'last_name.string'    => 'Last name must be a string.',
            'email.required'      => 'Email is required.',
            'email.email'         => 'Please enter a valid email address.',
            'phone.required'      => 'Phone number is required.',
            'phone.max'           => 'The phone number must not exceed 15 characters.',
            'postcode.required'   => 'Postcode is required.',
            'postcode.max'        => 'The postcode must not exceed 10 characters.',
            'address.required'    => 'Address is required.',
            'address.max'         => 'The address must not exceed 255 characters.',
            'street_name.required' => 'Street name is required.',
            'city.required'        => 'City name is required.',
            'city.max'             => 'The city name must not exceed 255 characters.',
        ];
    }
}
