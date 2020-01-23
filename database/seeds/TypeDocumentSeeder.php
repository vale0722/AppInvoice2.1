<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type__documents')->insert([[
            'code' => 'CC',
            'name' => 'Cedula de ciudadania',
        ], [
            'code' => 'CE',
            'name' => '	Cédula de extranjería',
        ],[
            'code' => 'TI',
            'name' => 'Tarjeta de identidad',
        ], [
            'code' => 'RC',
            'name' => 'Registro Civil',
        ],[
            'code' => 'NIT',
            'name' => 'Número de Identificación Tributaria',
        ], [
            'code' => 'RUT',
            'name' => 'Registro único tributario',
        ],[
            'code' => 'PPN',
            'name' => 'Pasaporte',
        ],]);
    }
}
