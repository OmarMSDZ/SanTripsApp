<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            //tipos de destino
            ['codigo' => 'restau', 'tipo' => 'destinos', 'nombre' => 'RESTAURANTE'],
            ['codigo' => 'mus', 'tipo' => 'destinos', 'nombre' => 'MUSEO'],
            ['codigo' => 'ciud', 'tipo' => 'destinos', 'nombre' => 'CIUDADES'],
            ['codigo' => 'mntn', 'tipo' => 'destinos', 'nombre' => 'MONTAÑAS'],
            ['codigo' => 'ntrlz', 'tipo' => 'destinos', 'nombre' => 'NATURALEZA'],
            ['codigo' => 'ply', 'tipo' => 'destinos', 'nombre' => 'PLAYAS'],
            ['codigo' => 'nctnl', 'tipo' => 'destinos', 'nombre' => 'NACIONALES'],  
            
            //tipos de paquetes
            ['codigo' => 'turi', 'tipo' => 'paquetes', 'nombre' => 'TURISTICO'],
            ['codigo' => 'histori', 'tipo' => 'paquetes', 'nombre' => 'HISTORICO'],
            ['codigo' => 'gastro', 'tipo' => 'paquetes', 'nombre' => 'GASTRONOMICO'],
            ['codigo' => 'edu', 'tipo' => 'paquetes', 'nombre' => 'EDUCATIVO'],
            
            
        ];
        DB::table('tipos')->insert($data);
    }
}
