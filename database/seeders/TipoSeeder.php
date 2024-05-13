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
            ['codigo' => 'restau', 'tipo' => 'destinos', 'nombre' => 'RESTAURANTE'],
            ['codigo' => 'mus', 'tipo' => 'destinos', 'nombre' => 'MUSEO'],
            ['codigo' => 'ciud', 'tipo' => 'destinos', 'nombre' => 'CIUDADES'],
            ['codigo' => 'mntn', 'tipo' => 'destinos', 'nombre' => 'MONTAÑAS'],
            ['codigo' => 'ntrlz', 'tipo' => 'destinos', 'nombre' => 'NATURALEZA'],
            ['codigo' => 'ply', 'tipo' => 'destinos', 'nombre' => 'PLAYAS'],
            ['codigo' => 'nctnl', 'tipo' => 'destinos', 'nombre' => 'NACIONALES'],  
        ];
        DB::table('tipos')->insert($data);
    }
}
