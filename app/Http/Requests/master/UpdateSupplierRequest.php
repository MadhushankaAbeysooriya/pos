<?php

namespace App\Http\Requests\master;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
            'name' => 'required|unique:suppliers,name,'.$this->supplier->id,
            'primary_contact' => 'required',
            'secondary_contact' => 'required',
            'address' => 'required',
            'reg_no' => 'required|unique:suppliers,reg_no,'.$this->supplier->id,
            'vat_no' => 'required|unique:suppliers,vat_no,'.$this->supplier->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The Name field is required.',
            'name.unique' => 'This Name already exists',
            'primary_contact.required' => 'The Primary Contact is required.',
            'secondary_contact.required' => 'The Secondary Contact is required.',
            'Address.required' => 'The Address is required.',
            'reg_no.required' => 'The Registered Number is required.',
            'reg_no.unique' => 'This Registered Number already exists',
            'vat_no.required' => 'The VAT Number is required.',
            'vat_no.unique' => 'This VAT Number already exists',
        ];
    }
}
