<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'name' => 'required|unique:suppliers',
            'primary_contact' => 'required',
            'secondary_contact' => 'required',
            'address' => 'required',
            'reg_no' => 'required|unique:suppliers',
            'vat_no' => 'required|unique:suppliers',
            'account_no' => 'required|unique:suppliers',
        ];
    }
}
