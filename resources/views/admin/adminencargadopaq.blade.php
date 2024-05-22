@extends('layouts.admin_layout_new')
@section('title', 'Administrador de Empleados encargados de paquetes')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/2.0.0/css/colReorder.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.bootstrap5.css">
@endsection

@section('content')


{{-- <div class="page-content p-5" id="content">
<!-- Contenido de admin -->
<h2>Admin Encargado paquetes <span class="text-gray float-end">SanTrips</span></h2>
<hr> --}}


<div class="pagetitle">
    <h1>Administración de Encargados de paquetes</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
        <li class="breadcrumb-item active">Administración de Encargados de paquetes</li>
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
                    <table id="tablaencargados_paquetes" class="table table-hover">
                        <!-- Contenido de la tabla -->
                        <thead class="">
                        <tr>
                            <!-- {{-- <th>Id</th> --}} -->
                            <th>Fecha</th>
                            <th>id_paquete_turistico</th>
                            <th>id_empleado</th>
                            
                        </tr>
                    </thead>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>


<form id="formCambiarencargado" action="" method="POST" class="form">
    <input name="codigo" value="0" type="hidden">
    <input name="estado" value="0" type="hidden">
    @csrf
</form>

<div class="modal fade" id="modalRegistroencargadopaq" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Registro De encargados de paquete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="registroencargado" class="row" action="" method="POST" class="form">
                @csrf

                <input type="hidden" id="codigo_encargad" name="codigo" value="0">

                <div class="col-4">
                    <div class="mb-3">
                        <label for="fechaingreso" class="form-label">Fecha</label>
                        <input type="date" name="fechaingreso" class="form-control limpiarForm" value={{date('Y-m-y')}} required>
                    </div>
                </div>

               

                <div class="col-4">
                    <div class="mb-3">
                        <label for="id_paquetes_turistico" class="form-label">id_paquetes_turistico</label>
                        <select name="id_paquetes_turistico" id="id_paquetes_turistico" class="form-select limpiarForm">

                            <option value="">===</option>
                            @foreach ($id_paquetes_turistico as $key)
                                <option value="{{$key->id}}">{{$key->Nombre}}</option>
                            @endforeach
                    
                        </select>
                    </div>
                </div>


                
                <div class="col-4">
                    <div class="mb-3">
                        <label for="idemp" class="form-label">Id empleado</label>
                        <select name="idemp" id="idemp" class="form-select limpiarForm">

                            <option value="">===</option>
                            @foreach ($id_empleado as $key)
                                <option value="{{$key->id}}">{{$key->Nombres}}</option>
                            @endforeach
                        
                        </select>
                    </div>
                </div>

                

           

                {{-- <div class="mb-3">
                    <button type="button" class="btn btn-success">Registrar</button>
                    <button type="button" class="btn btn-warning">Actualizar</button>
                    <br>
                    <p class="font-weight-bold text-uppercase px-3 small mt-3 mb-0">Otras Acciones</p>
                    <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="" style="text-decoration: none; color: white;"> Administrar Cargos</a></button>
                    <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="" style="text-decoration: none; color: white;"> Asignar Encargado Paquete</a></button>
                </div> --}}

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

<script src=" {{ asset('assets/js/admin_encargadopaq/admin_encargadopaq.js') }}"></script>

@endsection
