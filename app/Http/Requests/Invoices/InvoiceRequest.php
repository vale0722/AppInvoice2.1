<?php

namespace App\Http\Requests\Invoices;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3|max:100',
            'code' => 'required|unique:invoices',
            'client_id' => 'required|numeric|exists:clients,id',
            'company_id' => 'required|numeric|exists:companies,id',
        ];
    }

      /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'required' => "El :attribute de la factura es requerido",
            'code.unique' => 'El :attribute de factura ya exíste',
            'exists' => 'El :attribute no exíste'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function customValidationAttributes()
    {
        return [
            'title' => 'Título',
            'code' => 'Código',
            'client_id' => 'Id del Cliente',
            'company_id' => 'Id del Vendedor',
        ];
    }
}
