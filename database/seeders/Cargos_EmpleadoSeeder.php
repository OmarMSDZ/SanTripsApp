<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Cargos_EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['Cargo' => 'Encargado General', 'Sueldo' => '45000', 'Responsabilidades' => 'Manejar los recursos de la empresa'],
            ['Cargo' => 'Chofer Vehiculo Transporte', 'Sueldo' => '15000', 'Responsabilidades' => 'Conducir los vehiculos de transporte en los tours de SanTrips'],
            ['Cargo' => 'Encargado de Marketing', 'Sueldo' => '35000', 'Responsabilidades' => 'Manejar la imagen corporativa y publicidad de SanTrips'],
            
             
        ];
        DB::table('cargos_empleado')->insert($data);
    }
}