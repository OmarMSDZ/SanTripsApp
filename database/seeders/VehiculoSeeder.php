<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marcas = [
            //marcas de vehiculos
            ['MarcaVehiculo' => 'Toyota'],
            ['MarcaVehiculo' => 'Honda'],
            ['MarcaVehiculo' => 'Ford'],
            ['MarcaVehiculo' => 'Chevrolet'],
            ['MarcaVehiculo' => 'Nissan'],
            ['MarcaVehiculo' => 'BMW'],
            ['MarcaVehiculo' => 'Mercedes-Benz'],
            ['MarcaVehiculo' => 'Volkswagen'],
            ['MarcaVehiculo' => 'Hyundai'],
            ['MarcaVehiculo' => 'Kia'],
            ['MarcaVehiculo' => 'Audi'],
            ['MarcaVehiculo' => 'Lexus'],
            ['MarcaVehiculo' => 'Mazda'],
            ['MarcaVehiculo' => 'Subaru'],
            ['MarcaVehiculo' => 'Tesla']
            
        ];

        $modelos = [
            ['ModeloVehiculo' => 'Corolla', 'fk_IdMarcaVehiculo' => 1], // Toyota
            ['ModeloVehiculo' => 'Camry', 'fk_IdMarcaVehiculo' => 1],
            ['ModeloVehiculo' => 'Civic', 'fk_IdMarcaVehiculo' => 2], // Honda
            ['ModeloVehiculo' => 'Accord', 'fk_IdMarcaVehiculo' => 2],
            ['ModeloVehiculo' => 'F-150', 'fk_IdMarcaVehiculo' => 3], // Ford
            ['ModeloVehiculo' => 'Mustang', 'fk_IdMarcaVehiculo' => 3],
            ['ModeloVehiculo' => 'Silverado', 'fk_IdMarcaVehiculo' => 4], // Chevrolet
            ['ModeloVehiculo' => 'Malibu', 'fk_IdMarcaVehiculo' => 4],
            ['ModeloVehiculo' => 'Altima', 'fk_IdMarcaVehiculo' => 5], // Nissan
            ['ModeloVehiculo' => 'Sentra', 'fk_IdMarcaVehiculo' => 5],
            ['ModeloVehiculo' => '3 Series', 'fk_IdMarcaVehiculo' => 6], // BMW
            ['ModeloVehiculo' => 'X5', 'fk_IdMarcaVehiculo' => 6],
            ['ModeloVehiculo' => 'C-Class', 'fk_IdMarcaVehiculo' => 7], // Mercedes-Benz
            ['ModeloVehiculo' => 'E-Class', 'fk_IdMarcaVehiculo' => 7],
            ['ModeloVehiculo' => 'Golf', 'fk_IdMarcaVehiculo' => 8], // Volkswagen
            ['ModeloVehiculo' => 'Passat', 'fk_IdMarcaVehiculo' => 8],
            ['ModeloVehiculo' => 'Elantra', 'fk_IdMarcaVehiculo' => 9], // Hyundai
            ['ModeloVehiculo' => 'Sonata', 'fk_IdMarcaVehiculo' => 9],
            ['ModeloVehiculo' => 'Sorento', 'fk_IdMarcaVehiculo' => 10], // Kia
            ['ModeloVehiculo' => 'Sportage', 'fk_IdMarcaVehiculo' => 10],
            ['ModeloVehiculo' => 'A4', 'fk_IdMarcaVehiculo' => 11], // Audi
            ['ModeloVehiculo' => 'Q5', 'fk_IdMarcaVehiculo' => 11],
            ['ModeloVehiculo' => 'RX', 'fk_IdMarcaVehiculo' => 12], // Lexus
            ['ModeloVehiculo' => 'NX', 'fk_IdMarcaVehiculo' => 12],
            ['ModeloVehiculo' => 'Mazda3', 'fk_IdMarcaVehiculo' => 13], // Mazda
            ['ModeloVehiculo' => 'CX-5', 'fk_IdMarcaVehiculo' => 13],
            ['ModeloVehiculo' => 'Outback', 'fk_IdMarcaVehiculo' => 14], // Subaru
            ['ModeloVehiculo' => 'Forester', 'fk_IdMarcaVehiculo' => 14],
            ['ModeloVehiculo' => 'Model S', 'fk_IdMarcaVehiculo' => 15], // Tesla
            ['ModeloVehiculo' => 'Model 3', 'fk_IdMarcaVehiculo' => 15]
        ];

        $vehiculos = [
            [
            'Descripcion' => 'Prueba', 
            'Matricula' => 'pr123ueba',
            'FechaIngreso' => '2024-05-19',
            'CantidadPasajeros' => '12',
            'AnoVehiculo' => '2023',
            'Color' => 'NEGRO',
            'TipoCombustible' => 'GAS',
            'fk_IdTipoVehiculo' => '10',
            'fk_IdMarcaVehiculo' => '1',
            'fk_IdModeloVehiculo' => '1',
            ] 
          
        ];


        DB::table('Marca_vehiculo')->insert($marcas);
        DB::table('Modelo_vehiculo')->insert($modelos);
        DB::table('Vehiculo_transporte')->insert($vehiculos);
        
    }
}
