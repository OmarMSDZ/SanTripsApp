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
        // User::factory(10)->create();

         User::factory()->create(
            [

            
            // [
            //  'name' => 'Test User',
            //   'email' => 'test@example.com',
            // ],
            
            //definir los usuarios por default de admin y user
            [
                'nombres' => 'Admin',
                'apellidos' => 'Admin',
                'telefono' => '1231234123',
             'name' => 'Admin',
             'email' => 'admin@gmail.com',
             'password' => '12345678',
             'usertype' => 'admin',
            ],

            [
                'nombres' => 'User',
                'apellidos' => 'User',
                'telefono' => '1231234123',
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => '12345678',
                'usertype' => 'user',
            ],
   
            ]
        );

        $this->call(TipoSeeder::class);
        $this->call(Cargos_EmpleadoSeeder::class);
        $this->call(VehiculoSeeder::class);
        // $this->call(ProveedorSeeder::class);
        
        $this->call(AppSeeder::class);


    }
}
