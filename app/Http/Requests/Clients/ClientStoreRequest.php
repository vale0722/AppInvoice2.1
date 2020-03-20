<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
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
            'name' => 'required|min:3|max:100',
            'lastname' => 'required|min:3|max:100',
            'id_type' => 'required',
            'id_card' => 'required|unique:clients|min:8|max:10',
            'email' => 'required|unique:users|email',
            'cellphone' => 'required|min:10',
            'country' => 'required',
            'department' => 'required',
            'city' => 'required',
            'address' => 'required'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function customValidationMessages()
    {
        return  [
            'required' => "El :attribute del Cliente es un campo obligatorio",
            'unique' => 'El :attribute ya está registrado',
            'min' => 'El :attribute de tener mínimo :min letras',
            'max' => 'El :attribute de tener máximo :max letras'
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
            'name' => 'Nombre',
            'lastname' => 'Apellído',
            'id_type' => 'Tipo de identificación',
            'id_card' => 'Número de identificación',
            'email' => 'Correo Electrónico',
            'cellphone' => 'Número de Celular',
            'country' => 'País',
            'department' => 'Departamento',
            'city' => 'Ciudad',
            'address' => 'Dirección'
        ];
    }
}
