<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apps = [
            //aqui se definen los elementos del sidebar con sus rutas
            
            ['codigo' => 'dsh', 'orden' => 1, 'id_app_padre' => NULL, 'modulo' => 0, 'nombre' => 'Dashboard', 'ruta' => 'adminmenu/dashboard', 'icono' => 'bi bi-grid'],
            
            ['codigo' => 'usr', 'orden' => 2, 'id_app_padre' => NULL, 'modulo' => 0, 'nombre' => 'Usuarios', 'ruta' => 'adminusuarios', 'icono' => 'bi bi-person'],
            
            ['codigo' => 'emp', 'orden' => 3, 'id_app_padre' => NULL, 'modulo' => 0, 'nombre' => 'Empleados', 'ruta' => 'empleados.index', 'icono' => 'bi bi-person'],
            
            ['codigo' => 'paqt', 'orden' => 4, 'id_app_padre' => NULL, 'modulo' => 0, 'nombre' => 'Paquetes turisticos', 'ruta' => 'Paquetes.index', 'icono' => 'bi bi-calendar-range-fill'],
            
            ['codigo' => 'dst', 'orden' => 5, 'id_app_padre' => NULL, 'modulo' => 0, 'nombre' => 'Destinos', 'ruta' => 'destinos.index', 'icono' => 'bi bi-calendar-range-fill'],
            
            ['codigo' => 'empp', 'orden' => 6, 'id_app_padre' => NULL, 'modulo' => 0, 'nombre' => 'Empresas Proveedoras', 'ruta' => 'empresasProveedoras.index', 'icono' => 'bi bi-calendar-range-fill'],
            
            ['codigo' => 'vhcl', 'orden' => 7, 'id_app_padre' => NULL, 'modulo' => 0, 'nombre' => 'Vehículos', 'ruta' => 'vehiculos.index', 'icono' => 'bi bi-calendar-range-fill'],
            
            ['codigo' => 'rsv', 'orden' => 8, 'id_app_padre' => NULL, 'modulo' => 0, 'nombre' => 'Reservas', 'ruta' => 'reservashechas.index', 'icono' => 'bi bi-calendar-range-fill'],
            
            ['codigo' => 'pgs', 'orden' => 9, 'id_app_padre' => NULL, 'modulo' => 0, 'nombre' => 'Pagos', 'ruta' => 'pagos.index', 'icono' => 'bi bi-calendar-range-fill'],
            
            ['codigo' => 'oft', 'orden' => 10, 'id_app_padre' => NULL, 'modulo' => 0, 'nombre' => 'Ofertas', 'ruta' => 'ofertas.index', 'icono' => 'bi bi-calendar-range-fill'],
            
            ['codigo' => 'extr', 'orden' => 11, 'id_app_padre' => NULL, 'modulo' => 0, 'nombre' => 'Extras', 'ruta' => 'adminvarias', 'icono' => 'bi bi-calendar-range-fill'],
        ];
        DB::table('apps')->insert($apps);

    }
}
