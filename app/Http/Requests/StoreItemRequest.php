<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            'name' => 'required|unique:items,name,NULL,id,item_category_id,' . request('item_category_id'),
            'measurement_id' => 'required:items',
            'ration_sub_category_id' => 'required:items',
            'item_category_id' => 'required:items',
            'is_vat' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The Name field is required.',
            'measurement_id.required' => 'The measurement field is required.',
            'ration_sub_category_id.required' => 'This ration category field is required.',
            'item_category_id.required' => 'This item category field is required.',
            'is_vat.required' => 'VAT Available is required.',
        ];
    }
}
