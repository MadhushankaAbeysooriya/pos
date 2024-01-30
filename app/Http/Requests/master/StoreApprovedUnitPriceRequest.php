<?php

namespace App\Http\Requests\master;

use Illuminate\Foundation\Http\FormRequest;

class StoreApprovedUnitPriceRequest extends FormRequest
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
            'year' => 'required:approved_unit_prices',
            'quarter_id' => 'required:approved_unit_prices',
            'item_id' => 'required:approved_unit_prices',
            'price' => 'required:approved_unit_prices',
        ];
    }


    public function messages()
    {
        return [
            'year.required' => 'The year field is required.',
            'quarter_id.required' => 'The quarter field is required.',
            'item_id.required' => 'This item field is required.',
            'price.required' => 'This price field is required.',
        ];
    }

}
