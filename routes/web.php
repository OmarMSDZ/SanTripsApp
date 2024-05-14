<?php

//controladores

use App\Http\Controllers\ApiServiceCountryStateCityController;
use App\Http\Controllers\CargosEmpleadoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservaController;

use App\Http\Controllers\CategoriasPaquetesController;
use App\Http\Controllers\DestinoController;
use App\Http\Controllers\DestinosController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\EmpresasProveedorasController;
use App\Http\Controllers\EncargadosPaquetesController;
use App\Http\Controllers\ImagenesPaquetesController;

use App\Http\Controllers\MarcaVehiculoController;
use App\Http\Controllers\ModeloVehiculoController;
use App\Http\Controllers\OfertasController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PaquetesDestinosController;
use App\Http\Controllers\PaquetesTuristicosController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ReservacionController;
use App\Http\Controllers\ReservasHechasController;
use App\Http\Controllers\TipoDestinoController;
use App\Http\Controllers\TipoServiciosproveedorController;
use App\Http\Controllers\TipoVehiculoController;
use App\Http\Controllers\VehiculoEmpleadoController;
use App\Http\Controllers\VehiculosPaquetesController;
use App\Http\Controllers\VehiculoTransporteController;
use Illuminate\Support\Facades\Route;

 Route::get('/welcome', function () {
     return view('welcome');
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
Las que usen GET, son solo para navegar
Las que usen POST, son solo para enviar informacion a traves de los formulario
*/
// Rutas para navegar interfaces admin (GET)
Route::get('/admin', function () {
    return view('admin/adminmenu');
})->name('adminmenu');

Route::get('/admin/dashboard', function () {
    return view('admin/adminmenu');
})->name('adminmenu/dashboard');

//rutas para el nav (GET)
Route::get('/admin/usuarios', function () {
    return view('admin/adminusuarios');
})->name('adminusuarios');






Route::resource('admin/Paquetes', PaquetesTuristicosController::class)->parameters([
    'Paquetes' => 'paquetes_turisticos'
]);






Route::resource('admin/empresasProveedoras',EmpresasProveedorasController::class)->parameters([
    'EmpresasProveedoras' => 'empresasProveedoras'
]);

Route::resource('admin/vehiculos', VehiculoTransporteController::class)->parameters([
    'Vehiculos' => 'vehiculos'
]);

//para administrar las reservas realizadas
Route::resource('admin/reservas', ReservasHechasController::class)->parameters([
    'Reservashechas' => 'reservashechas'
]);
Route::get('admin/reservas', [ReservasHechasController::class, 'index'])->name('reservashechas.index');


Route::resource('admin/pagos', PagoController::class)->parameters([
    'Pagos' => 'pagos'
]);

// Route::resource('admin/incidentes', IncidentesController::class)->parameters([
//     'Incidentesadmin' => 'incidentesadmin'
// ]);
// Route::get('admin/reservas', [IncidentesController::class, 'index'])->name('reservashechas.index');





Route::get('/admin/incidentes', function () {
    return view('admin/adminincidentes');
})->name('adminincidentes');

Route::get('/admin/varias', function () {
    return view('admin/adminvarias');
})->name('adminvarias');

//rutas interfaz de empleado admin

Route::resource('admin/cargospuestos', CargosEmpleadoController::class)->parameters([
    'Cargospuestos' => 'cargospuestos'
]);

Route::resource('admin/encargadospaquetes',EncargadosPaquetesController::class)->parameters([
    'Encargadospaquetes' => 'encargadospaquetes'
]);

//rutas interfaz de paquetes turisticos admin

//RUTAS NUEVAS
Route::resource('admin/Categorias_paquetes', CategoriasPaquetesController::class)->parameters([
    'Categorias_paquetes' => 'categorias_paquetes'
]);



Route::resource('admin/imagenespaquetes', ImagenesPaquetesController::class)->parameters([
    'Imagenespaquetes' => 'imagenespaquetes'
]);

//rutas interfaz de destinos admin

Route::get('/admin/provincias', function () {
    return view('admin/adminprovincias');
})->name('adminprovincias');

// RUTAS DE ADMIN
Route::middleware('auth')->prefix('admin')->group( function () {

    Route::controller(DestinoController::class)->prefix('destinos')->group( function () {
        Route::get('/', 'index')->name('destinos.index');
        Route::get('/data/table', 'getDestinos')->name('destinos.getDestinos');
        Route::get('/data/code/{id_destino}', 'getDestino')->name('destinos.getDestino');
        Route::post('/', 'store')->name('destinos.store');
        Route::post('/cambiar_estado/{id_destino}', 'cambiarDestino')->name('destinos.cambiar_estado');
        Route::post('/update/{id_destino}', 'update')->name('destinos.update');
    });

    Route::controller(EmpleadosController::class)->prefix('empleados')->group( function () {

        Route::get('/', 'index')->name('empleados.index');
        Route::get('/data', 'getEmpleados')->name('empleados.getEmpleados');
        Route::get('/data/{id_empleado}', 'getEmpleado')->name('empleados.getEmpleado');

        Route::post('/', 'store')->name('empleados.store'); 
        Route::post('/update/{id_empleado}', 'update')->name('empleados.update');

        Route::post('/cambiar_estado/{id_empleado}', 'cambiarEmpleado')->name('empleados.cambiar_estado');


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
    });




});



// Route::resource('admin/tiposdestino',TipoDestinoController::class)->parameters([
//     'Tiposdestino' => 'tiposdestino'
// ]);




//rutas interfaz de empresas proveedoras admin

Route::resource('admin/tiposerviciosprov',TipoServiciosproveedorController::class)->parameters([
    'Tiposerviciosprov' => 'tiposerviciosprov'
]);
//rutas interfaz de vehiculos admin

Route::resource('admin/marcasvehiculos', MarcaVehiculoController::class)->parameters([
    'MarcasVehiculos' => 'marcasvehiculos'
]);

Route::resource('admin/modelosvehiculos',ModeloVehiculoController::class)->parameters([
    'Modelosvehiculos' => 'modelosvehiculos'
]);


Route::resource('admin/tiposvehiculo', TipoVehiculoController::class)->parameters([
    'Tiposvehiculo' => 'tiposvehiculo'
]);

Route::resource('admin/asignarvehiculoempleado', VehiculoEmpleadoController::class)->parameters([
    'Asignarvehiculoempleado' => 'asignarvehiculoempleado'
]);

Route::resource('admin/asignarvehiculopaquete',VehiculosPaquetesController::class)->parameters([
    'Psignarvehiculopaquete' => 'asignarvehiculopaquete'
]);



//rutas interfaz de reservas admin
Route::get('/admin/vistadetalladareserva', function () {
    return view('admin/vistadetalladareserva');
})->name('vistadetalladareserva');

//rutas vista detallada pago
Route::get('/admin/vistadetalladapago', function () {
    return view('admin/vistadetalladapago');
})->name('vistadetalladapago');

//rutas vista detallada incidentes
Route::get('/admin/vistadetalladaincidente', function () {
    return view('admin/vistadetalladaincidente');
})->name('vistadetalladaincidente');


// Rutas para formularios interfaces admin (POST)


// Rutas para navegar interfaces usuario (GET), la de inicio es la primera que sale al abrir la app
Route::get('/', function () {
    return view('usuario/inicio');
})->name('inicio');


Route::get('/incidentes', function () {
    return view('usuario/incidentes');
})->name('incidentes');

//esta solo entra con login
Route::get('/reservas_realizadas', function () {
    return view('usuario/reservas_realizadas');
})->middleware(['auth', 'verified'])->name('reservas_realizadas');


Route::get('/paquetes_turisticos', function () {
    return view('usuario/paquetes');
})->name('paquetes_turisticos');



// Rutas para formulario de reserva, solo se ven con el usuario logueado
Route::get('/formulario-reserva/{id}', [ReservaController::class, 'mostrarFormulario'])->middleware(['auth', 'verified'])->name('formulario_reserva');
Route::post('/procesar-reserva', [ReservaController::class, 'procesarReserva'])->name('procesar_reserva');
Route::post('/reservar_paquete/{paquete_id}', [ReservaController::class, 'vistaReservacion'])->name('vista_reservacion');
Route::post('/formulario_reserva', [ReservacionController::class, 'store'])->name('Reservacion.store');

//autentificacion de usuario
Route::get('admin/adminmenu', [HomeController::class,'index']);


//vaina de paypal

Route::get('/paypalprueba', [PayPalController::class, 'index']);
Route::get('/create/{amount}', [PayPalController::class, 'create']);
Route::post('/complete', [PayPalController::class, 'complete']);

//
Route::prefix('/v1')->group(function () {
    Route::controller(ApiServiceCountryStateCityController::class)->group(function () {
        Route::get('/country', 'getCountries')->name('api.countries');
        Route::get('/state/{country?}', 'getStates')->name('api.states');
        Route::get('/city/{country?}/{state?}', 'getCities')->name('api.cities');
    });
});

require __DIR__.'/auth.php';
