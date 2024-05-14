@extends('layouts.admin_layout_new')
@section('title', 'Administrador de Ofertas')

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
<h2>Admin Reservas <span class="text-gray float-end">SanTrips</span></h2>
<hr>
<h2>Reservas Registradas</h2>
<h3>Mostrar Reservas Por Estado:</h3>
<select name="clasificacion" id="clasificacion" class="form-select">
    <option value="PENDIENTE">Pendiente</option>
    <option value="EN PROCESO">En Proceso</option>
    <option value="CANCELADA">Cancelada</option>
    <option value="COMPLETADA">Completada</option>
</select>
<!-- esto desde aqui va de forma dinamica, para mostrar una tarjeta con una descripcion breve de la reserva, y un link para proceder a otra pagina donde se detallará mas -->
<!-- Todo lo que está en asteriscos es informacion dinámica de cada reserva, por cada reserva debe de generarse una tarjeta igual que esta -->
<!-- El formulario para realizar la reserva está del lado del cliente y no en admin -->
<!-- Se mostraran por categorias, las cuales se basaran en el estado, ya sea pendientes, en proceso y completado-->
<div class="row my-5">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card ">
                  <div class="card-body">
                    <img src="" class="card-img-absolute" alt="" />
                    <p hidden>*id*</p>
                    <h4 class="font-weight-normal mb-3">*breve descripcion del paquete reservado*<i class="mdi mdi-chart-line mdi-24px float-end"></i>
                    </h4>
                    <p class="font-weight-normal">Usuario: *nombre del usuario que reserva*</p>
                    
                    <p class="font-weight-normal">*Fecha de la reservacion*</p>
                    
                    <p class="mb-5">Estatus: *Estatus de la reservacion*</p>
                    
                    <!-- Aqui debería enviar con el id del incidente seleccionado a esta pagina -->
                    <h6 class="card-text"><a href="{{ Route('vistadetalladareserva')}}"  style="text-decoration: none; color: black;">Vista Detallada</a></h6>
                  </div>
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

 
@endsection