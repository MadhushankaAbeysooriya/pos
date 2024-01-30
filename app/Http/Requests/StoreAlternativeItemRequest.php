<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAlternativeItemRequest extends FormRequest
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
            'alternative_item_id'=>[
                'required',
                Rule::unique('alternative_items')
                    ->where('item_id', $this->id)
            ],
        ];
    }

    public function messages()
    {
        return [
            'alternative_item_id.required' => 'The alternative item field is required.',
            'alternative_item_id.unique' => 'This alternative item is already exists',
        ];
    }
}
