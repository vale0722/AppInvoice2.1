<?php

namespace App\Http\Requests\Invoices;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',

            'code' => [
                'required',
                Rule::unique('invoices')->ignoreModel($this->route('invoice'))
            ],
            'client' => 'required|numeric|exists:clients,id',
            'stateReceipt' => 'required',
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
            'client' => 'Id del Cliente',
        ];
    }
}
