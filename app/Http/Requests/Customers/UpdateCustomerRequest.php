<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'string|min:3|max:50',
            'job' => 'string|min:3|max:50',
            'tin' => 'required|integer|digits:9',
            'email' => 'required|email|unique:users,email',
            'mobile_phone' => 'string|min:3|max:50',
            'phone_number' => 'nullable|string|min:3|max:50',
            'alternative_phone' => 'nullable|string|min:3|max:50',
            'address' => 'required|string|min:3|max:150',
            'city' => 'required|string|min:3|max:150',
            'state' => 'required|string|min:3|max:150',
            'postcode' => 'required|string|min:3|max:150',
            'country' => 'required|string|min:3|max:150',
            'birthday' => 'required|date',
            'gender' => 'string|max:1|in:M,F',
            'notes' => 'nullable|string|min:3|max:300',
            'type' => 'required|string|min:3|max:30',
        ];
    }
}
