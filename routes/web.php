<?php

use App\Http\Controllers\ProfileController;
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

//rutas para el header (GET)
Route::get('/admin/usuarios', function () {
    return view('admin/adminusuarios');
})->name('adminusuarios');

Route::get('/admin/empleados', function () {
    return view('admin/adminempleados');
})->name('adminempleados');

// prueba del crud generado
 
//


Route::get('/admin/paquetes', function () {
    return view('admin/adminpaquetes');
})->name('adminpaquetes');

Route::get('/admin/destinos', function () {
    return view('admin/admindestinos');
})->name('admindestinos');

Route::get('/admin/empresasproveedoras', function () {
    return view('admin/adminempresasproveedoras');
})->name('adminempresasproveedoras');

Route::get('/admin/vehiculos', function () {
    return view('admin/adminvehiculos');
})->name('adminvehiculos');

Route::get('/admin/reservas', function () {
    return view('admin/adminreservas');
})->name('adminreservas');

Route::get('/admin/pagos', function () {
    return view('admin/adminpagos');
})->name('adminpagos');

Route::get('/admin/incidentes', function () {
    return view('admin/adminincidentes');
})->name('adminincidentes');

Route::get('/admin/varias', function () {
    return view('admin/adminvarias');
})->name('adminvarias');

//rutas interfaz de empleado admin (GET)

Route::get('/admin/cargospuestos', function () {
    return view('admin/admincargospuestos');
})->name('admincargospuestos');

Route::get('/admin/encargadospaquetes', function () {
    return view('admin/asignarencargadopaquete');
})->name('asignarencargadopaquete');

//rutas interfaz de paquetes turisticos admin (GET)

Route::get('/admin/categoriaspaquetes', function () {
    return view('admin/admincategoriapaquetes');
})->name('admincategoriapaquetes');

Route::get('/admin/imagenespaquetes', function () {
    return view('admin/adminimagenespaquetes');
})->name('adminimagenespaquetes');

Route::get('/admin/ofertas', function () {
    return view('admin/adminofertas');
})->name('adminofertas');

//rutas interfaz de destinos admin (GET)

Route::get('/admin/provincias', function () {
    return view('admin/adminprovincias');
})->name('adminprovincias');

Route::get('/admin/tiposdestino', function () {
    return view('admin/admintiposdestino');
})->name('admintiposdestino');

Route::get('/admin/asignardestinospaquetes', function () {
    return view('admin/asignardestinospaquetes');
})->name('asignardestinospaquetes');

//rutas interfaz de empresas proveedoras admin (GET)

Route::get('/admin/tiposerviciosprov', function () {
    return view('admin/admintiposerviciosprov');
})->name('admintiposerviciosprov');

//rutas interfaz de vehiculos admin (GET)

Route::get('/admin/marcasvehiculos', function () {
    return view('admin/adminmarcasvehiculos');
})->name('adminmarcasvehiculos');


Route::get('/admin/modelosvehiculos', function () {
    return view('admin/adminmodelosvehiculos');
})->name('adminmodelosvehiculos');

Route::get('/admin/tiposvehiculo', function () {
    return view('admin/admintiposvehiculo');
})->name('admintiposvehiculo');

Route::get('/admin/asignarvehiculoempleado', function () {
    return view('admin/asignarvehiculoempleado');
})->name('asignarvehiculoempleado');

Route::get('/admin/asignarvehiculopaquete', function () {
    return view('admin/asignarvehiculopaquete');
})->name('asignarvehiculopaquete');
 
//rutas interfaz de reservas admin (GET)
Route::get('/admin/vistadetalladareserva', function () {
    return view('admin/vistadetalladareserva');
})->name('vistadetalladareserva');
 
//rutas vista detallada pago (GET)
Route::get('/admin/vistadetalladapago', function () {
    return view('admin/vistadetalladapago');
})->name('vistadetalladapago');
 
//rutas vista detallada incidentes (GET)
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

Route::get('/reservas_realizadas', function () {
    return view('usuario/reservas_realizadas');
})->name('reservas_realizadas');

Route::get('/paquetes_turisticos', function () {
    return view('usuario/paquetes');
})->name('paquetes_turisticos');

Route::get('/formulario_reservas', function () {
    return view('usuario/formulario_reservas');
})->name('formulario_reservas');


// Rutas para formularios interfaces usuario (POST)


require __DIR__.'/auth.php';
