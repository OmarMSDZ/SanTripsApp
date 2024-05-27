@extends('layouts.admin_layout_new')
@section('title', 'Administrador de Ofertas')

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
<div class="page-content p-5" id="content">
<!-- Contenido de admin reserva -->
<h2>Admin Reservas <span class="text-gray float-end">SanTrips</span></h2>
<h3>Vista Detallada</h3>
<hr>

<!-- Todo lo que está en asteriscos es informacion dinámica de cada reserva, por cada reserva debe de generarse una tarjeta igual que esta -->
<!--La informacion de cada reserva se tomara del id de la tarjeta seleccionada en la vista de las reserva-->

@foreach ($reservas as $reserva)
 <form action="{{route('reservashechas.update', $reserva->idreserva)}}" method="POST" class="form" id="vistadetallada">    

@csrf
<h2>Reserva Hecha Por: {{$reserva->usuario}}</h2> 

<p id="codigo" hidden>{{$reserva->idreserva}}</p>
<p><span style="font-weight:bold">Paquete Reservado: </span>{{$reserva->nombrepaquete}}</p>
<p><span style="font-weight:bold">Para la Fecha:</span> {{$reserva->fechareserva}}</p>
<p><span style="font-weight:bold">Cantidad de Personas:</span> {{$reserva->cantpersonasreserva}}</p>
<p><span style="font-weight:bold">Total (RD$):</span> {{$reserva->montoreserva}}</p>
<p><span style="font-weight:bold">Estado de Reserva: </span>{{$reserva->estado}}</p>


<hr>

<label for="estado"> <h4> Actualizar estado de la Reservación</h4></label>
<select name="estado" id="" class="form-select">
    <option value="ACTIVA">Activa</option>
    <option value="PAGO PENDIENTE">Pago Pendiente</option>
    <option value="EN PROCESO">En Proceso</option>
    <option value="CANCELADA">Cancelada</option>
    <option value="COMPLETADA">Completada</option>
</select>
{{-- Para poder cambiar la fecha de la reserva en caso de haber algun inconveniente con la misma
  digase, que la empresa determine que no se puede hacer ese día --}}
<label for="cambiarFecha"><h4>Cambiar Fecha de Reservación (En caso de haber algún inconveniente con la misma)</h4></label>
<input type="date" name="cambiarFecha" class="form-control" id="" value="{{$reserva->fechareserva}}">
<br>

 
<button type="submit" class="btn btn-success">Actualizar Estado o Fecha Reserva</button>
 
</form>

<!-- Formulario de eliminación -->
<form action="{{ route('reservashechas.destroy', $reserva->idreserva) }}" method="POST" class="form-delete">
  @csrf
  @method('DELETE')
  <br>
  <button type="submit" class="btn btn-danger btnEliminar">
      <i class="bi bi-trash"></i> Eliminar
  </button>
</form>

 
<br>
 
@endforeach

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

  {{-- IMPORTANTE, INCLUIR EL JS CORRESPONDIENTE A ESTA VISTA PARA QUE FUNCIONE DE MANERA ADECUADA --}}
   <script src="{{asset('assets/js/admin_reservas/admin_reservas.js')}}"></script>  

@endsection