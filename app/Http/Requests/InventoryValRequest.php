<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class InventoryValRequest extends FormRequest
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
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $inventory = $this->route('inventory');
            return $this->updateRules($inventory);
        }
        return [
            'part_name' => 'required|string|max:255',
            'skuId' => 'required|string|max:100|unique:inventories,skuId',
            'categoryId' => 'required|nullable|string|max:100',
            'stock_quantity' => 'required|integer|min:0',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'min_stock' => 'nullable|integer|min:0',
            'description' => 'nullable|string'
        ];
    }

    public function updateRules($inventory){
        return [
            'part_name' => 'required|string|max:255',
            'skuId' => [
                'required',
                'numeric',
                'max:100',
                Rule::unique('inventories', 'skuId')->ignore($inventory->id),
            ],
            'categoryId' => 'required|nullable|string|max:100',
            'stock_quantity' => 'required|integer|min:0',
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'min_stock' => 'nullable|integer|min:0',
            'description' => 'nullable|string'
        ];
    }
}
