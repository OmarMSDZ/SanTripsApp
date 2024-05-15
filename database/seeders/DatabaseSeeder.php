<?php

namespace Database\Seeders;

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
             'name' => 'Admin',
             'email' => 'admin@gmail.com',
             'password' => '12345678',
             'usertype' => 'admin',
            ],

            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => '12345678',
                'usertype' => 'user',
            ],
   
            ]
        );

        $this->call(TipoSeeder::class);
        $this->call(Cargos_EmpleadoSeeder::class);
        
        $this->call(AppSeeder::class);

    }
}
