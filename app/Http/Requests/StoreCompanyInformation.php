<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyInformation extends FormRequest
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
            'id'                        => 'nullable',
            'company_name'              => 'required|string',
            'company_phone_number'      => 'required|string',
            'company_email'             => 'required|string',
            'favicon'                   => 'nullable|image',
            'logo'                      => 'nullable|image',
            'address'                   => 'required|string',
            'company_description'       => 'required|string',
        ];
    }
}
