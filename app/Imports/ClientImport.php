<?php

namespace App\Imports;

use App\Client;
use Maatwebsite\Excel\Concerns\ToModel;

class ClientImport implements ToModel
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
}

