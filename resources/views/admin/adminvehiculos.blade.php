
@extends('layouts.admin_layout_new')
@section('title', 'Administrador de Vehiculos')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/2.0.0/css/colReorder.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.bootstrap5.css">
    {{-- Para permitir eliminar registros --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">


@endsection

@section('content')


{{-- <div class="page-content p-5" id="content">
<!-- Contenido de admin empleados -->
<h2>Admin Empleados <span class="text-gray float-end">SanTrips</span></h2>
<hr> --}}


<div class="pagetitle">
    <h1>Administración de Vehiculos</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
        <li class="breadcrumb-item active">Administración de Vehiculos</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Filtro</h5>
            <div class="row d-flex">

                <div class="col-12">

                    <form id="formBusqueda" class="row justify-center align-items-center">
                          {{-- <div class="col-md-3 col-sm-4 col-lg-4">
                            <label for="tipo_cliente">Tipos</label>
                            <div class="form-group">
                                <select class="form-select default-select2" name="" id="" required>
                                    <option value="0"> ====</option>
                                      @foreach ($tipos_vehiculos as $key)
                                        <option value="{{$key->id}}">{{$key->nombre}} </option>
                                    @endforeach  
                                  </select>
                            </div>
                        </div>    --}}

                        <div class="col-md-3 col-sm-4 col-lg-3">
                            <label for="estado">Estatus</label>
                            <div class="form-group">
                                <select class="form-select default-select2" name="estado" id="estado" required>
                                    <option value="ACTIVO">Activo</option>
                                    <option value="INACTIVO">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 mt-3 offset-lg-1 offset-md-4">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-outline-secondary btn-sm mx-2" type="submit">
                                    <span class="d-sm-inline-block ms-1">
                                        <i class="bi bi-search"></i> Buscar
                                    </span>
                                </button>
                                <button class="btn btn-primary btn-sm" id="btnNuevoRegistro" type="button">
                                    <span class="d-sm-inline-block ms-1">
                                        <i class="bi bi-file-plus"></i> NUEVO REGISTRO
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                </div>
                <br>
                <div class="col-12 table-container">
                    <table id="tablaVehiculo" class="table table-hover">
                        <!-- Contenido de la tabla -->
                        <thead class="">
                        <tr>
                  
                            <th>Descripción</th>
                            <th>Matricula</th>
                            <th>Fecha de Ingreso</th>
                            <th>Cantidad Pasajeros</th>
                            <th>Año del Vehículo</th>
                            <th>Color</th>
                            <th>Tipo Combustible</th>
                            <th>Tipo Vehiculo</th>
                            <th>Marca Vehiculo</th>
                            <th>Modelo Vehiculo</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>


<form id="formCambiarVehiculo" action="" method="POST" class="form">
    <input name="codigo" value="0" type="hidden">
    <input name="estado" value="0" type="hidden">
    @csrf
</form>

<div class="modal fade" id="modalRegistroVehiculo" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Registro De Vehiculo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="registroVehiculo" class="row" action="" method="POST" class="form">
                @csrf

                <input type="hidden" id="codigo_vehiculo" name="codigo" value="0">

                <div class="col-4">
                    <div class="mb-3">
                     <label for="descripcion" class="form-label">Descripcion</label> 
                     <textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control-limpiarForm" placeholder="Descripcion del vehiculo"></textarea>
                    </div>
                </div>

                <div class="col-4">
                    <div class="mb-3">
                        <label for="matricula" class="form-label">Matricula</label>
                        <input type="text" name="matricula" class="form-control limpiarForm" placeholder="Matricula del vehiculo" required>
                    </div>
                </div>

                <div class="col-4">
                    <div class="mb-3">
                        <label for="fechaingreso" class="form-label">Fecha de Ingreso</label>
                        <input type="date" name="fechaingreso" class="form-control limpiarForm" placeholder="Fecha de Ingreso del Vehículo" required>
                    </div>
                </div>

                <div class="col-4">

                    <div class="mb-3">
                        <label for="cantidadpasajeros" class="form-label">Cantidad Pasajeros</label>
                        <input type="number" name="cantidadpasajeros" class="form-control limpiarForm" placeholder="Cantidad de pasajeros" required>
                    </div>
                </div>

                <div class="col-4">
                    <div class="mb-3">
                        <label for="anovehiculo" class="form-label">Año del Vehiculo</label>
                        <input type="number" name="anovehiculo" class="form-control limpiarForm" placeholder="Año del vehiculo" minlength="4" maxlength="4" min="1985" max="3000" required>
                    </div>
                </div>

                <div class="col-4">
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <select id="color" name="color" class="form-select limpiarForm">
                            <option value="">===</option>
                            <option value="ROJO">Rojo</option>
                            <option value="VERDE">Verde</option>
                            <option value="AZUL">Azul</option>
                            <option value="AMARILLO">Amarillo</option>
                            <option value="NEGRO">Negro</option>
                            <option value="BLANCO">Blanco</option>
                            <option value="MORADO">Púrpura</option>
                            <option value="NARANJA">Naranja</option>
                            <option value="ROSA">Rosa</option>
                            <option value="MARRON">Marrón</option>
                            <option value="GRIS">Gris</option>
                            <option value="CIAN">Cian</option>
                            <option value="MAGENTA">Magenta</option>
                            <option value="LIMA">Lima</option>
                        </select>

                    </div>
                </div>

                <div class="col-4">
                    <div class="mb-3">
                        <label for="tipocombustible" class="form-label">Combustible</label>
                        <select id="colores" name="tipocombustible" class="form-select limpiarForm">
                            <option value="">===</option>
                            <option value="GASOLINA">Gasolina</option>
                            <option value="DIESEL">Diesel</option>
                            <option value="GAS">Gas</option>
                            <option value="ELECTRICO">Electrico</option>
                            <option value="HIBRIDO">Hibrido</option>
                        </select>

                    </div>
                </div>

                <div class="col-4">
                    <div class="mb-3">
                        <label for="tipovehiculo" class="form-label">Tipo de Vehículo</label>
                        <select name="tipovehiculo" id="tipovehiculo" class="form-select limpiarForm">

                            <option value="">===</option>
                              @foreach ($tipos_vehiculos as $key)
                                <option value="{{$key->id}}">{{$key->nombre}}</option>
                            @endforeach  
                        
                        </select>
                    </div>
                </div>

                <div class="col-4">
                    <div class="mb-3">
                        <label for="marcavehiculo" class="form-label">Marca del Vehículo</label>
                        <select name="marcavehiculo" id="marcavehiculo" class="form-select limpiarForm">

                            <option value="">===</option>
                             @foreach ($marcas_vehiculos as $key)
                                <option value="{{$key->IdMarcaVehiculo}}">{{$key->MarcaVehiculo}}</option>
                            @endforeach 
                        
                        </select>
                    </div>
                </div>

                <div class="col-4">
                    <div class="mb-3">
                        <label for="modelovehiculo" class="form-label">Modelo del Vehículo</label>
                        <select name="modelovehiculo" id="modelovehiculo" class="form-select limpiarForm">

                            <option value="">===</option>
                             @foreach ($modelos_vehiculos as $key)
                                <option value="{{$key->IdModeloVehiculo}}">{{$key->ModeloVehiculo}}</option>
                            @endforeach  
                        
                        </select>
                    </div>
                </div>

                <div class="col-4">
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select name="estado" id="estado" class="form-select" required>
                            <option value="ACTIVO">Activo</option>
                            <option value="INACTIVO">Inactivo</option>
                        </select>
                    </div>
                </div>

 

            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="btnProcesar">Guardar</button>
        </div>
      </div>
    </div>
</div>

@endsection

@section('javascript')
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.1/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/colreorder/2.0.0/js/colReorder.dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.0/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.bootstrap5.js"></script>

<script src=" {{ asset('assets/js/admin_vehiculos/admin_vehiculos.js') }}"></script>

@endsection
