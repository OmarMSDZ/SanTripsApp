@extends('layouts.admin_layout_new')
@section('title', 'Administrador de Reservas')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.0/css/responsive.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/2.0.0/css/colReorder.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.dataTables.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.1/css/buttons.bootstrap5.css">
@endsection

@section('content')

<div class="page-content p-5" id="content">
<!-- Contenido de admin reservas -->

<div class="pagetitle">
  <h1>Administración de Reservas</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
      <li class="breadcrumb-item active">Administración de Reservas</li>
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

                <form id="formBusqueda" class="row justify-center align-items-center" method="GET" action="{{ route('reservashechas.index') }}">
                  <div class="col-md-3 col-sm-4 col-lg-3">
                      <label for="estado">Estado de la Reservación</label>
                      <div class="form-group">
                          <select class="form-select default-select2" name="estado" id="estado" required>
                              <option value="">Seleccionar Estado</option>
                              <option value="">Todos</option>
                              <option value="ACTIVA" {{ request('estado') == 'ACTIVA' ? 'selected' : '' }}>Activa</option>
                              <option value="EN PROCESO" {{ request('estado') == 'EN PROCESO' ? 'selected' : '' }}>En Proceso</option>
                              <option value="COMPLETADA" {{ request('estado') == 'COMPLETADA' ? 'selected' : '' }}>Completada</option>
                              <option value="CANCELADA" {{ request('estado') == 'CANCELADA' ? 'selected' : '' }}>Cancelada</option>
                          </select>
                      </div>
                  </div>

                  <div class="col-md-3 col-sm-4 col-lg-3">
                    <label for="fechareserva">Fecha</label>
                    <div class="form-group">
                      <input type="date" name="fechareserva" class="form-control" id="fechaseleccionada" value="{{request('fechareserva')}}">
                    </div>
                </div>

                  <div class="col-lg-4 mt-3 offset-lg-1">
                      <div class="">
                          <button class="btn btn-outline-secondary btn-sm mx-2" type="submit">
                              <span class="d-sm-inline-block ms-1">
                                  <i class="bi bi-search"></i> Buscar
                              </span>
                          </button>
                      </div>
                  </div>
              </form>
              
                  <br>
                  <hr>
<!-- esto desde aqui va de forma dinamica, para mostrar una tarjeta con una descripcion breve de la reserva, y un link para proceder a otra pagina donde se detallará mas -->
<!-- Todo lo que está en asteriscos es informacion dinámica de cada reserva, por cada reserva debe de generarse una tarjeta igual que esta -->
<!-- El formulario para realizar la reserva está del lado del cliente y no en admin -->
<!-- Se mostraran por categorias, las cuales se basaran en el estado, ya sea pendientes, en proceso y completado-->
 
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
  
  {{-- De esta forma se imprime cada paquete en la pagina luego de hacer la consulta --}}
  @foreach($reservas as $reserva)
 
      
  <div class="col">
      <div class="card h-100">
          <div class="card-body"> 

              {{-- <p hidden class="id">{{$reserva->idreserva}}</p> --}}
              <h2 class="card-title">{{$reserva->nombrepaquete}}</h2>

              <p class="card-text"><span style="font-weight:bold">Usuario: </span> {{$reserva->usuario}}</p>
              <p class="card-text"> <span style="font-weight:bold">Fecha Solicitada: </span> {{$reserva->fechareserva}}</p>
              <hr>
              <p class="card-text"> <span style="font-weight:bold">Estado de Reservación: </span> {{$reserva->estado}}</p>
          
           
                   
                  <form action="{{route('reservashechas.procesarReservaVistaDetallada')}}" method="post">
                      @csrf <!-- Agrega el token CSRF para protección -->
                      {{-- En esta parte se pasa el id de la reserva a la otra vista --}}
                      <input type="text" name="id" value="{{$reserva->idreserva}}" hidden>
                      <center>
                      <button type="submit" class="btn mt-3">Ir a Vista Detallada</button>
                      </center>
                    </form>  
                  
               
          </div>
      </div>
  </div> 
  @endforeach
  

<!-- Aquí irían las otras tarjetas de los paquetes turísticos, siguiendo el mismo patrón, se generarían automaticamente desde la BD -->
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

 
@endsection