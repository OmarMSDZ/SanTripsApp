<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['Descripcion' => 'Prueba', 'Porcentaje' => '1', 'FechaDesde' => '2024-05-14', 'FechaHasta' => '2025-05-14', 'creado_por' => '1', 'estado' => 'ACTIVO'],
        
             
        ];
        DB::table('ofertas')->insert($data);
    }
}
