@extends('layouts.admin_layout_new')



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
            <h5 class="card-title">Example Card</h5>

            <form id="formBusqueda" class="row justify-center align-items-center">
                <div class="col-md-3 col-sm-4 col-lg-4">
                    <label for="tipo_cliente">Tipo de cliente</label>
                    <div class="form-group">
                        <select class="form-select default-select2" name="tipo_cliente" id="tipo_cliente" required>
                            <option value="0"> ====</option>
                            {{-- @foreach ($tipos_clientes as $tipo)
                                <option value="{{$tipo->id}}">{{$tipo->nombre}} </option>
                            @endforeach --}}
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
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>NOMBRE</th>
                            <th>EMPRESA</th>
                            <th>TIPO</th>
                            <th>PROVINCIA</th>
                            <th>HORARIO</th>
                            <th>ESTADO</th>
                            <th>CREADO EN</th>
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
                                <option value="1">Traer de BD</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="tipo_destino" class="form-label">Tipo de Destino</label>
                            <select name="tipo_destino" id="tipo_destino" class="form-select" required>
                                @foreach ($tipos_destinos as $key)
                                    <option value="{{$key->id}}">{{$key->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="provincia" class="form-label">Provincia</label>
                            <select name="provincia" id="provincia" class="form-select">
                                <option value="1">Traer de BD</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="abierto_desde" class="form-label">Abierto Desde</label>
                            <input type="time" name="abierto_desde" id="abierto_desde" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="abierto_hasta" class="form-label">Abierto Hasta</label>
                            <input type="time" name="abierto_hasta" id="abierto_hasta" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="observaciones" class="form-label">Observaciones</label>
                            <textarea name="observaciones" id="observaciones" rows="3" class="form-control"></textarea>
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

    <script src=" {{ asset('assets/js/admin_destinos/destinos.js') }}"></script>

  @endsection

