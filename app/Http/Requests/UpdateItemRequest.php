<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
            'name' => 'required|unique:items,name,' . $this->item->id,
            'barcode' => 'required|unique:items,barcode,' . $this->item->id,
            'item_category_id' => 'required',
            'measurement_id' => 'required',
            'brand_id',
            'rol' => 'required|integer|min:0',
            'product_image',
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'The Name field is required.',
            'name.unique' => 'The Name already exist.',
            'barcode.required' => 'The Barcode field is required.',
            'barcode.unique' => 'The Barcode already exist.',
            'item_category_id.required' => 'This item category field is required.',
            'measurement_id.required' => 'The measurement field is required.',
            'rol.required' => 'The Alert Quantity field is required.',
            'rol.integer' => 'The Alert Quantity must be an integer.',
            'rol.min' => 'The Alert Quantity must be more than 0.',
        ];
    }
}
