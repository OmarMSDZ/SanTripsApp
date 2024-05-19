
@extends('layouts.admin_layout_new')
@section('title', 'Administrador de Paquetes Turísticos')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/2.0.0/css/colReorder.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.bootstrap5.css">

    {{-- Para poder eliminar registros --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

 

<div class="pagetitle">
    <h1>Administración de Paquetes Turísticos</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('adminmenu')}}">Home</a></li>
        <li class="breadcrumb-item active">Administración de Paquetes Turísticos</li>
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
                        <div class="col-md-3 col-sm-4 col-lg-4">
                            <label for="tipo_cliente">Categoría</label>
                            <div class="form-group">
                                <select class="form-select default-select2" name="provincia" id="filtro_provincia" required>
                                    <option value="0"> ====</option>
                                     {{-- @foreach ($categoriapaq as $key)
                                        <option value="{{$key->id}}">{{$key->nombre}} </option>
                                    @endforeach  --}}
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
                    <br>
                </div>
                <br>
                <div class="col-12 table-container">
                    <table id="tablaPaquete" class="table table-hover">
                        <!-- Contenido de la tabla -->
                        <thead class="">
                        <tr>
                            {{-- <th>Id</th> --}}
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Costo</th>
                            <th>N° Personas</th>
                            <th>Edades</th>
                            <th>Idiomas</th>
                            <th>Alojamiento</th>
                            <th>Tiempo_estimado</th>
                            <th>Disponibilidad</th>
                            <th>Categoría</th>
                            <th>Oferta Aplicada</th>
                            
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


<form id="formCambiarPaquete" action="" method="POST" class="form">
    <input name="codigo" value="0" type="hidden">
    <input name="estado" value="0" type="hidden">
    @csrf
</form>

<div class="modal fade" id="modalRegistroPaquete" tabindex="-1">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Registro De Paquete Turístico</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="registroPaquete" class="row" action="" method="POST" class="form">
                @csrf

                <input type="hidden" id="codigo_paquete" name="codigo" value="0">

                <div class="col-4">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control limpiarForm" placeholder="Nombre del Paquete" required>
                    </div>
                </div>

                <div class="col-4">
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <textarea name="descripcion" id="" cols="30" rows="10" class="form-control limpiarForm" placeholder="Descripcion del paquete" required></textarea>
                      </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                      <label for="costo" class="form-label">Costo (RD$)</label>
                      <input type="number" name="costo" class="form-control limpiarForm" step="0.01" placeholder="Costo del paquete en RD$" required>
                  </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                      <label for="numpersonas" class="form-label">Num. Max. Personas</label>
                      <input type="number" name="numpersonas" class="form-control limpiarForm" step="0.01" placeholder="Numero maximo de personas" required>
                  </div>
                </div>

              
                <div class="col-4">
                    <div class="mb-3">
                        <label for="edades" class="form-label">Edades</label>
                        <select name="edades" id="edades" class="form-select limpiarForm">
                          <option value="">===</option>
                          <option value="TODAS LAS EDADES">Todas las Edades</option>
                          <option value="ADOLESCENTES Y ADULTOS">Adolescentes y Adultos</option>
                          <option value="SOLO ADULTOS">Solo Adultos</option>
                        </select>
                     </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                      <label for="idiomas" class="form-label">Idiomas</label>
                      <select name="idiomas" id="idiomas" class="form-select limpiarForm">
                        <option value="">===</option>
                        <option value="ESPAÑOL">Español</option>
                        <option value="INGLES">Inglés</option>
                        <option value="INGLES Y ESPAÑOL">Inglés y Español</option>
                      </select>
                   </div>
                 </div>



                 <div class="col-4">
                  <div class="mb-3">
                      <label for="alojamiento" class="form-label">Alojamiento</label>
                      <select name="alojamiento" id="alojamiento" class="form-select limpiarForm">
                        <option value="DISPONIBLE (HOTEL)">Disponible (Hotel)</option>
                        <option value="DISPONIBLE (A ESPECIFICAR)">Disponible (A Especificar)</option>
                        <option value="NO DISPONIBLE">No Disponible</option>
                      </select>
                   </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                      <label for="tiempoestimado" class="form-label">Duración Estimada (En Horas)</label>
                      <input type="number" name="tiempoestimado" class="form-control limpiarForm" placeholder="Duración estimada del paquete (En Horas)" required>
                  </div>
                </div>

                <div class="col-4">
                  <div class="mb-3">
                      <label for="disponibilidad" class="form-label">Disponibilidad</label>
                      <select name="disponibilidad" id="disponibilidad" class="form-select limpiarForm">
                        <option value="DISPONIBLE">Disponible</option>
                        <option value="NO DISPONIBLE">No Disponible</option>
                      </select>
                   </div>
                </div>
                

                <div class="col-4">
                  <div class="mb-3">
                      <label for="categoriapaq" class="form-label">Categoria Paquete</label>
                      <select name="categoriapaq" id="categoriapaq" class="form-select limpiarForm">

                          <option value="">===</option>
                          @foreach ($categoriapaq as $key)
                              <option value="{{$key->id}}">{{$key->nombre}}</option>
                          @endforeach 
                      
                      </select>
                  </div>
              </div>


                <div class="col-4">
                    <div class="mb-3">
                        <label for="oferta" class="form-label">Ofertas Aplicadas</label>
                        <select name="oferta" id="oferta" class="form-select limpiarForm">

                            <option value="">===</option>
                            @foreach ($ofertas as $key)
                                <option value="{{$key->IdOferta}}">{{$key->Descripcion}}</option>
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

<script src=" {{ asset('assets/js/admin_paquetes/admin_paquetes.js') }}"></script>

@endsection
