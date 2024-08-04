<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'contract_name' => 'required',
            'contract_email' => 'required|unique:clients,contact_email,' .$this->client->id,
            'contract_phone_number' => 'required|max:10|min:10',
            'company_name' => 'required',
            'company_address' => 'required',
            'company_phone_number' => 'required|max:10|min:10',
        ];
    }
}
