<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         
        $this->call(TipoSeeder::class);
        $this->call(Cargos_EmpleadoSeeder::class);
        $this->call(VehiculoSeeder::class);
        // $this->call(ProveedorSeeder::class);
        
        $this->call(AppSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(OfertaSeeder::class);
        


    }
}
