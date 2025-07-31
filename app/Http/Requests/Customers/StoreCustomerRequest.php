<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasVerifiedEmail();
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
            'name' => 'required|string|min:3|max:50',
            'job' => 'required|string|min:3|max:50',
            'tin' => 'required|integer|digits:9',
            'email' => 'required|email|unique:users,email',
            'mobile_phone' => 'required|string|min:3|max:50',
            'phone_number' => 'nullable|string|min:3|max:50',
            'alternative_phone' => 'nullable|string|min:3|max:50',
            'address' => 'required|string|min:3|max:150',
            'city' => 'required|string|min:3|max:50',
            'state' => 'required|string|min:3|max:50',
            'postcode' => 'required|string|min:3|max:50',
            'country' => 'required|string|min:3|max:50',
            'birthday' => 'required|date',
            'gender' => 'required|string|max:1|in:M,F,O',
            'notes' => 'nullable|string|min:3|max:300',
            'type' => 'required|string|min:3|max:30',
        ];
    }
}
