<?php

//controladores

use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\ApiServiceCountryStateCityController;
use App\Http\Controllers\CargosEmpleadoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservaController;

use App\Http\Controllers\CategoriasPaquetesController;
use App\Http\Controllers\DestinoController;
use App\Http\Controllers\DestinosController;
use App\Http\Controllers\EmpleadosController;
 
use App\Http\Controllers\EncargadosPaquetesController;
use App\Http\Controllers\ImagenesPaquetesController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\MarcaVehiculoController;
use App\Http\Controllers\ModeloVehiculoController;
use App\Http\Controllers\OfertasController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PaquetesDestinosController;
use App\Http\Controllers\PaquetesTuristicosController;
use App\Http\Controllers\PaqueteVistaController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ProveedoresController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\ReservasHechasController;
use App\Http\Controllers\ReservasRealizadasVistaController;
use App\Http\Controllers\TipoDestinoController;
use App\Http\Controllers\TipoServiciosproveedorController;
use App\Http\Controllers\TipoVehiculoController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\VehiculoEmpleadoController;
use App\Http\Controllers\VehiculosPaquetesController;
use App\Http\Controllers\VehiculoTransporteController;
use Illuminate\Support\Facades\Route;


use App\Mail\pruebacorreos;
use Illuminate\Support\Facades\Mail;
//  Route::get('/welcome', function () {
//      return view('welcome');
//  });
 Route::get('/correo', function () {
    // de esta forma se llama el controlador de los correos con los parametros

    // return (new pruebacorreos("prueba"))->render();
    $response = Mail::to('santripsrd@gmail.com')->send(new pruebacorreos("prueba"));

    dump($response);

});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
En esta parte se van a definir las rutas de la aplicacion
*/
// Rutas para navegar interfaces admin (GET)


//rutas para el nav (GET)
Route::get('/admin/usuarios', function () {
    return view('admin/adminusuarios');
})->name('adminusuarios');
 
//para administrar las reservas realizadas
Route::resource('admin/reservas', ReservasHechasController::class)->parameters([
    'Reservashechas' => 'reservashechas'
]);
 
//rutas interfaz de destinos admin

Route::get('/admin/provincias', function () {
    return view('admin/adminprovincias');
})->name('adminprovincias');

// RUTAS DE ADMIN
Route::middleware('auth')->prefix('admin')->group( function () {
 
    Route::controller(AdminMenuController::class)->prefix('admin/dashboard')->group( function () {
        Route::get('/', 'index')->name('admin.index'); 
    });

    Route::controller(DestinoController::class)->prefix('destinos')->group( function () {
        Route::get('/', 'index')->name('destinos.index');
        Route::get('/data/table', 'getDestinos')->name('destinos.getDestinos');
        Route::get('/data/code/{id_destino}', 'getDestino')->name('destinos.getDestino');
        Route::post('/', 'store')->name('destinos.store');
        Route::post('/cambiar_estado/{id_destino}', 'cambiarDestino')->name('destinos.cambiar_estado');
        Route::post('/update/{id_destino}', 'update')->name('destinos.update');

        //eliminar registros
        Route::delete('/destroy/{id_destino}', 'destroy')->name('destinos.destroy');
        
    });

    Route::controller(EmpleadosController::class)->prefix('empleados')->group( function () {

        Route::get('/', 'index')->name('empleados.index');
        Route::get('/data', 'getEmpleados')->name('empleados.getEmpleados');
        Route::get('/data/{id_empleado}', 'getEmpleado')->name('empleados.getEmpleado');

        Route::post('/', 'store')->name('empleados.store'); 
        Route::post('/update/{id_empleado}', 'update')->name('empleados.update');

        Route::post('/cambiar_estado/{id_empleado}', 'cambiarEmpleado')->name('empleados.cambiar_estado');
      
        //eliminar registros
        Route::delete('/destroy/{id_empleado}', 'destroy')->name('empleados.destroy');


    });

       //ruta de paquete destinos
       Route::controller(PaquetesDestinosController::class)->prefix('paqdestino')->group( function () {

        Route::get('/', 'index')->name('paqdestino.index');
        Route::get('/data', 'getPaquetesdestinos')->name('paqdestino.getPaquetesdestinos');
        Route::get('/data/{id}', 'getPaquetedestino')->name('paqdestino.getPaquetedestino');
        Route::post('/', 'store')->name('paqdestino.store'); 
        Route::post('/update/{id}', 'update')->name('paqdestino.update');
        Route::post('/cambiar_estado/{id}', 'cambiarPaquetesdestino')->name('paquetesdestino.cambiar_estado');
        Route::delete('/{id}', 'delete')->name('paquetesdestino.delete');


    });


           //ruta de encargados paquetes
           Route::controller(EncargadosPaquetesController::class)->prefix('encargadopaq')->group( function () {

            Route::get('/', 'index')->name('encargadopaq.index');
            Route::get('/data', 'getEncargadospaquetes')->name('encargadopaq.getEncargadospaquetes');
            Route::get('/data/{id}', 'getEncargadopaquete')->name('encargadopaq.getEncargadopaquete');
            Route::post('/', 'store')->name('encargadopaq.store'); 
            Route::post('/update/{id}', 'update')->name('encargadopaq.update');
            Route::post('/cambiar_estado/{id}', 'cambiarencargadopaq')->name('encargadopaq.cambiar_estado');
            Route::delete('/{id}', 'delete')->name('encargadopaq.delete');
    
        });
    
    //el prefix es el nombre con el que lo vamos a llamar en la url
    
    Route::controller(OfertasController::class)->prefix('ofertas')->group( function () {

        //ir a la vista principal
        Route::get('/', 'index')->name('ofertas.index');
        //obtener datos completos
        Route::get('/data', 'getOfertas')->name('ofertas.getOfertas');
        //obtener un dato especifico
        Route::get('/data/{id_oferta}', 'getOferta')->name('ofertas.getOferta');
        //guardar
        Route::post('/', 'store')->name('ofertas.store'); 
        //actualizar
        Route::post('/update/{id_oferta}', 'update')->name('ofertas.update');
        //cambiar estado 
        Route::post('/cambiar_estado/{id_oferta}', 'cambiarOferta')->name('ofertas.cambiar_estado');
        //eliminar registros
        Route::delete('/destroy/{id_oferta}', 'destroy')->name('ofertas.destroy');
        
    });

    Route::controller(PaquetesTuristicosController::class)->prefix('paquetes')->group( function () {

        //ir a la vista principal
        Route::get('/', 'index')->name('paquetes.index');
        //obtener datos completos
        Route::get('/data', 'getPaquetes')->name('paquetes.getPaquetes');
        //obtener un dato especifico
        Route::get('/data/{id_paquete}', 'getPaquete')->name('paquetes.getPaquete');
        //guardar
        Route::post('/', 'store')->name('paquetes.store'); 
        //actualizar
        Route::post('/update/{id_paquete}', 'update')->name('paquetes.update');
        //cambiar estado 
        Route::post('/cambiar_estado/{id_paquete}', 'cambiarPaquete')->name('paquetes.cambiar_estado');
        //eliminar registros
        Route::delete('/destroy/{id_paquete}', 'destroy')->name('paquetes.destroy');
        //limpiar imagenes de paquete
        Route::post('/deleteImagenes/{id_paquete}', 'deleteImagenes')->name('paquetes.deleteImagenes');


    });

    Route::controller(ProveedoresController::class)->prefix('proveedores')->group( function () {

        //ir a la vista principal
        Route::get('/', 'index')->name('proveedores.index');
        //obtener datos completos
        Route::get('/data', 'getProveedores')->name('proveedores.getProveedores');
        //obtener un dato especifico
        Route::get('/data/{id_proveedor}', 'getProveedor')->name('proveedores.getProveedor');
        //guardar
        Route::post('/', 'store')->name('proveedores.store'); 
        //actualizar
        Route::post('/update/{id_proveedor}', 'update')->name('proveedores.update');
        //cambiar estado 
        Route::post('/cambiar_estado/{id_proveedor}', 'cambiarProveedor')->name('proveedores.cambiar_estado');
        //eliminar registros
        Route::delete('/destroy/{id_proveedor}', 'destroy')->name('proveedores.destroy');

    });

    Route::controller(UsuariosController::class)->prefix('usuarios')->group( function () {

        //ir a la vista principal
        Route::get('/', 'index')->name('usuarios.index');
        //obtener datos completos
        Route::get('/data', 'getUsuarios')->name('usuarios.getUsuarios');
        //obtener un dato especifico
        Route::get('/data/{id_usuario}', 'getUsuario')->name('usuarios.getUsuario');
        //guardar
        Route::post('/', 'store')->name('usuarios.store'); 
        //actualizar
        Route::post('/update/{id_usuario}', 'update')->name('usuarios.update');
        //cambiar estado 
        Route::post('/cambiar_estado/{id_usuario}', 'cambiarUsuario')->name('usuarios.cambiar_estado');
    });


    Route::controller(VehiculoTransporteController::class)->prefix('vehiculos')->group( function () {

        //ir a la vista principal
        Route::get('/', 'index')->name('vehiculos.index');
        //obtener datos completos
        Route::get('/data', 'getVehiculos')->name('vehiculos.getVehiculos');
        //obtener un dato especifico
        Route::get('/data/{id_vehiculo}', 'getVehiculo')->name('vehiculos.getVehiculo');
        //guardar
        Route::post('/', 'store')->name('vehiculos.store'); 
        //actualizar
        Route::post('/update/{id_vehiculo}', 'update')->name('vehiculos.update');
        //cambiar estado 
        Route::post('/cambiar_estado/{id_vehiculo}', 'cambiarVehiculo')->name('vehiculos.cambiar_estado');
        //eliminar registros
        Route::delete('/destroy/{id_vehiculo}', 'destroy')->name('vehiculos.destroy');
    });


    Route::controller(ReservasHechasController::class)->prefix('reservashechas')->group( function () {
        //ir a la vista principal
        Route::get('/', 'index')->name('reservashechas.index');
        //ir a vista detallada con el id
        Route::post('/procesarReservaVistaDetallada', 'procesarReservaVistaDetallada')->name('reservashechas.procesarReservaVistaDetallada');
        Route::get('/vistadetallada/{id}', 'mostrarFormularioVistaDetallada')->name('reservashechas.vistaDetallada');
        //actualizar
        Route::post('/update/{id_reserva}', 'update')->name('reservashechas.update');
        //eliminar registros
        Route::delete('/destroy/{id_reserva}', 'destroy')->name('reservashechas.destroy');
    });
});


  
 
// Rutas para navegar interfaces usuario , la de inicio es la primera que sale al abrir la app 
Route::get('/', [InicioController::class,'index'])->name('inicio');

Route::get('/incidentes', function () {
    return view('usuario/incidentes');
})->name('incidentes');


Route::get('usuario/paquetes', [PaqueteVistaController::class,'index'])->name('paquetes_turisticos');

//  Esta de reservas realizadas sale solo al hacer login 
Route::get('/reservas_realizadas', [ReservasRealizadasVistaController::class,'index'])->middleware(['auth', 'verified'])->name('reservas_realizadas');

// Rutas para formulario de reserva, solo se ven con el usuario logueado
Route::get('/formulario-reserva/{id}', [ReservaController::class, 'mostrarFormulario'])->middleware(['auth', 'verified'])->name('formulario_reserva');
Route::post('/procesar-reserva', [ReservaController::class, 'procesarReserva'])->name('procesar_reserva');
Route::post('/reservar_paquete/{paquete_id}', [ReservaController::class, 'vistaReservacion'])->name('vista_reservacion');
Route::post('/formulario_reserva', [ReservacionController::class, 'store'])->name('Reservacion.store');
//rutas para cancelar reserva
Route::get('/cancelar-reserva', [ReservaController::class, 'mostrarFormularioCancelacion'])->middleware(['auth', 'verified'])->name('formulario_cancelar');
Route::post('/reservas_realizadas/cancelar', [ReservasRealizadasVistaController::class, 'cancelarReservacion'])->middleware(['auth', 'verified'])->name('cancelarReservacion');

//autentificacion de usuario
Route::get('admin/adminmenu', [HomeController::class,'index']);

//paypal (PRUEBA)
Route::get('/paypalprueba', [PayPalController::class, 'index']);
Route::get('/create/{amount}', [PayPalController::class, 'create']);
Route::post('/complete', [PayPalController::class, 'complete']);

//rutas para la api de provincias paises y demas 
Route::prefix('/v1')->group(function () {
    Route::controller(ApiServiceCountryStateCityController::class)->group(function () {
        Route::get('/country', 'getCountries')->name('api.countries');
        Route::get('/state/{country?}', 'getStates')->name('api.states');
        Route::get('/city/{country?}/{state?}', 'getCities')->name('api.cities');
    });
});

require __DIR__.'/auth.php';
