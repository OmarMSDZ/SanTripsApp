@extends('layouts.admin_layout_new')
@section('title', 'Administrador de Paquetes destinos')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/2.0.0/css/colReorder.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.bootstrap5.css">
@endsection

@section('content')


{{-- <div class="page-content p-5" id="content">
<!-- Contenido de admin empleados -->
<h2>Admin paquetes destinos <span class="text-gray float-end">SanTrips</span></h2>
<hr> --}}


<div class="pagetitle">
    <h1>Administración de Paquetes Destinos</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
        <li class="breadcrumb-item active">Administración de Paquetes destinos</li>
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
                    <div class="table-responsive">
                        <table id="tablapaquetes_destinos" class="table table-hover" width="100%">
                            <!-- Contenido de la tabla -->
                            <thead class="">
                            <tr>
                                 
                                <!-- <th>id_paquetes_turistico</th>
                                <th>id_destino</th>
                                <th>accion</th> -->
                            </tr>
                        </thead>
                        </table>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalRegistropaqdestino" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Registro De Paquetes Destinos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="registropaqdestino" class="row" action="" method="POST" class="form">
                @csrf

                <input type="hidden" id="codigo_paqdestino" name="codigo" value="0">

                <div class="col-6 col-sm-12 col-lg-6">
                    <div class="mb-3">
                        <label for="paquete_turistico" class="form-label">Paquete turistico</label>
                        <select name="paquete_turistico" id="paquete_turistico" class="form-select limpiarForm" required>
                            <option value="">===</option>
                            @foreach ($id_paquetes_turistico as $key)
                                <option value="{{$key->id}}">{{$key->Nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-6 col-sm-12 col-lg-6">
                    <div class="mb-3">
                        <label for="destino" class="form-label">Destino</label>
                        <select name="destino" id="destino" class="form-select limpiarForm" required>

                            <option value="">===</option>
                            @foreach ($id_destino as $key)
                                <option value="{{$key->id}}">{{$key->nombre}}</option>
                            @endforeach
                        
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

<script src=" {{ asset('assets/js/admin_paqdestino/adminpaqdestino.js') }}"></script>

@endsection
