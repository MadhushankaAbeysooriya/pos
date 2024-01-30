<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDemandFromLocationRequest extends FormRequest
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
            'year' => 'required|unique:demand_from_locations',
            'demand_ref' => 'required',
            'item_id' => 'required',
            'supplier_id' => 'required',
            'qty' => 'required',
            'location_id' => 'required',
            'request_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'year' => 'The year field is required.',
            'demand_ref' => 'The demand ref field is required.',
            'item_id' => 'The item field is required.',
            'supplier_id' => 'The supplier field is required.',
            'qty' => 'The qty field is required.',
            'location_id' => 'The location field is required.',
            'request_date' => 'The request date field is required.',
        ];
    }
}
