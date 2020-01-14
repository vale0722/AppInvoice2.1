<?php

namespace App\Imports;

use App\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class ClientImport implements ToModel, WithValidation, WithBatchInserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $client = new Client([
            'name' => $row[0],
            'last_name' => $row[1],
            'id_type' => $row[2],
            'id_card' => $row[3],
            'email' => $row[4],
            'cellphone' => $row[5],
            'country' => $row[6],
            'city' => $row[7],
            'address' => $row[8]
        ]);
        return $client;
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:100',
            'last_name' => 'required|min:3|max:100',
            'id_type' => 'required',
            'id_card' => 'required|unique:clients',
            'email' => 'required|unique:clients|email',
            'cellphone' => 'required|min:10',
            'country' => 'required',
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
        return [
            'required' => "El :attribute del Cliente es requerido",
            'unique' => 'El :attribute ya está registrado'
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
            'last_name' => 'Apellído',
            'id_type' => 'Tipo de identificación',
            'id_card' => 'Número de identificación',
            'email' => 'Correo Electrónico',
            'cellphone' => 'Número de Celular',
            'country' => 'País',
            'city' => 'Ciudad',
            'address' => 'Dirección'
        ];
    }
}
