<?php

namespace App\Http\Requests;

use LDAP\Result;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RepairValReq extends FormRequest
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
            'name' => 'required|exists:customers,id',
            'phone_number' => 'required|string|max:15',
            'device_model' => 'required|exists:phone_models,id',
            'issue' => 'required|string|max:255',
            'priority' => 'required|exists:priorities,id',
            'status' => 'required|exists:statuses,id',
        ];
    }

    public function updatedRules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:255', Rule::unique('customers', 'name')->ignore($this->route('repair')->customer_id)],
            'phone_number' => 'required|string|max:15',
            'issue_description' => 'required|string|max:255',
            'estimated_cost' => 'required|numeric',
            'final_cost' => 'required|numeric',
            'repair_date' => 'required|date',
            'completion_date' => 'required|date',
            'notes' => 'string',
            'pickup_date' => 'nullable|date',
        ];
    }
}
