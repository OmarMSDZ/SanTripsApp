@extends('layouts.admin_layout_new')
@section('title', 'Administrador de Destinos')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/2.0.0/css/colReorder.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.bootstrap5.css">
@endsection

@section('content')


<div class="pagetitle">
    <h1>Administración de Destinos</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Administración de Destinos</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Filtro</h5>

            <form id="formBusqueda" class="row justify-center align-items-center">
                <div class="col-md-3 col-sm-4 col-lg-4">
                    <label for="tipo_cliente">Provincias</label>
                    <div class="form-group">
                        <select class="form-select default-select2" name="provincia" id="filtro_provincia" required>
                            <option value="0"> ====</option>
                            @foreach ($provincias as $key)
                                <option value="{{$key->id}}">{{$key->nombre}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-4 col-lg-3">
                    <label for="estatus">Estatus</label>
                    <div class="form-group">
                        <select class="form-select default-select2" name="estatus" id="estatus" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
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
            <hr>
            <div class="table-responsive is-hide">
                <table class="table table-striped table-hover table-sm" id="table_id" class="display" style="width:100%">
                    <thead class="">
                        <tr>
                            {{-- <th>#</th> --}}
                            <th>NOMBRE</th>
                            <th>EMPRESA</th>
                            <th>PROVINCIA</th>
                            <th>HORA DESDE</th>
                            <th>HORA HASTA</th>
                            <th>CREADO EN</th>
                            <th>ESTADO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <form id="formCambiarDestino" action="" method="POST" class="form">
    <input name="codigo" value="0" type="hidden">
    <input name="estado" value="0" type="hidden">
    @csrf
  </form>

  <div class="modal fade" id="modalRegistroDestino" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Registro De Destinos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="registroDestino" action="" method="POST" class="form">
                @csrf
                <input type="hidden" id="codigo_destino" name="codigo_destino" value="0">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="nombre_destino" class="form-label">Nombre del Destino</label>
                            <input type="text" name="nombre_destino" id="nombre_destino" class="form-control limpiarForm" placeholder="Nombre del destino" required>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="empresa" class="form-label">Empresa</label>
                            <select name="empresa" id="empresa" class="form-select selectLimpiarForm" required>
                                <option value="">===</option>
                                @foreach ($proveedores as $key)
                                    <option value="{{$key->id}}">{{$key->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="tipo_destino" class="form-label">Tipo de Destino</label>
                            <select name="tipo_destino" id="tipo_destino" class="form-select selectLimpiarForm" required>
                                <option value="">===</option>
                                @foreach ($tipos_destinos as $key)
                                    <option value="{{$key->id}}">{{$key->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="provincia" class="form-label">Provincia</label>
                            <select name="provincia" id="provincia" class="form-select selectLimpiarForm">
                                <option value="">===</option>
                                @foreach ($provincias as $key)
                                    <option value="{{$key->id}}">{{$key->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="abierto_desde" class="form-label">Abierto Desde</label>
                            <input type="time" name="abierto_desde" id="abierto_desde" class="form-control limpiarForm" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="abierto_hasta" class="form-label">Abierto Hasta</label>
                            <input type="time" name="abierto_hasta" id="abierto_hasta" class="form-control limpiarForm" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea name="observaciones" id="observaciones" rows="3" class="form-control limpiarForm"></textarea>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    {{-- <button type="button submit" name="save" class="btn btn-success">Registrar</button>
                    <button type="button submit" name="update" class="btn btn-warning">Actualizar</button> --}}
                    <br>
                    {{-- <p class="font-weight-bold text-uppercase px-3 small mt-3 mb-0">Otras Acciones</p>
                    <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="{{ Route('adminprovincias')}}"  style="text-decoration: none; color: white;"> Administrar Provincias</a></button>
                    <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="{{ Route('admintiposdestino')}}"  style="text-decoration: none; color: white;"> Administrar Tipos</a></button>
                    <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="{{ Route('asignardestinospaquetes')}}"  style="text-decoration: none; color: white;">Asignar a Paquete</a></button> --}}
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="btnGuardar">Guardar</button>
        </div>
      </div>
    </div>
</div><!-- End Extra Large Modal-->

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

    <script src=" {{ asset('assets/js/admin_destinos/destinos.js') }}"></script>

  @endsection

