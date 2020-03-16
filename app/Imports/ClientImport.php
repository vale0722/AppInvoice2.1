<?php

namespace App\Imports;

use App\User;
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
        $user = new User([
            'name' => $row[0],
            'lastname' => $row[1],
            'email' => $row[4],
        ]);
        $client = new Client([
            'id_type' => $row[2],
            'id_card' => $row[3],
            'cellphone' => $row[5],
            'country' => $row[6],
            'department' => $row[7],
            'city' => $row[8],
            'address' => $row[9],
            'user_id' => $user->id,
            'creator_id' => auth()->user->id,
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
            'lastname' => 'required|min:3|max:100',
            'id_type' => 'required',
            'id_card' => 'required|unique:clients',
            'email' => 'required|unique:clients|email',
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
            'department' => 'Departamento',
            'city' => 'Ciudad',
            'address' => 'Dirección'
        ];
    }
}
