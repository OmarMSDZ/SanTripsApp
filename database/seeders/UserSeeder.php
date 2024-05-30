<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['nombres' => 'Omar Jadis', 'apellidos' => 'Morales Diaz', 'Telefono' => '8299375993', 'name' => 'OmarM', 'email' => 'rdbluedog@gmail.com', 'password' => '12345678', 'usertype' => 'admin', 'estado' => 'ACTIVO'],
            ['nombres' => 'Darlenys', 'apellidos' => 'Acevedo', 'Telefono' => '8094717827', 'name' => 'Darlenys', 'email' => 'dar.acevedo26@gmail.com', 'password' => '12345678', 'usertype' => 'admin', 'estado' => 'ACTIVO'],
            ['nombres' => 'Herlyn', 'apellidos' => 'De Leon', 'Telefono' => '8296055004', 'name' => 'Herlyn', 'email' => 'deleonherlyn55@gmail.com', 'password' => '12345678', 'usertype' => 'admin', 'estado' => 'ACTIVO'],
            ['nombres' => 'Test', 'apellidos' => 'User', 'Telefono' => '8091231234', 'name' => 'TestUser', 'email' => 'santripsrd@gmail.com', 'password' => '12345678', 'usertype' => 'user', 'estado' => 'ACTIVO'],

             
        ];
        DB::table('Users')->insert($data);
    }
}
