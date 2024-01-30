<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRationSubCategoryRequest extends FormRequest
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
            'ration_category_id' => 'required',
            'name' => 'required|unique:ration_sub_categories',
        ];
    }

    public function messages()
    {
        return [
            'ration_category_id.required' => 'Ration Category field is required.',
            'name.required' => 'The Name field is required.',
            'name.unique' => 'This Name is already exists',
        ];
    }
}
