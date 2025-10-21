<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerValRequest extends FormRequest
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
        if($this->isMethod('put') || $this->isMethod('patch')) {
            $customer = $this->route('customer');
            return $this->showCustomerRules();
        }
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone_number' => 'required|string|max:20',
            'address' => 'nullable|string'
        ];
    }

    public function showCustomerRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('customers')->ignore($this->customer->id)],
            'phone_number' => 'required|string|max:20',
            'address' => 'nullable|string'
        ];
    }
}
