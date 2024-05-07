<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de admin incidentes -->
<h2>Admin Pagos <span class="text-gray float-end">SanTrips</span></h2>
<h3>Vista Detallada</h3>
<hr>

<!-- Todo lo que está en asteriscos es informacion dinámica de cada incidente, por cada incidente debe de generarse una tarjeta igual que esta -->
<!--La informacion de cada incidente se tomara del id de la tarjeta seleccionada en la vista de los incidentes-->
<form action="" method="POST" class="form">

<input name="idfactura" type="text" class="form-control" hidden>
<h2>Usuario: *Usuario*</h2> 
<p>Factura N°: *Factura N°*</p>
<p>Fecha Ultimo Pago: *Fecha ultimo pago*</p>
<!-- Mostrar Pagos realizados a esta factura, esto va dinamico por cada uno -->
<div class="row my-5">
              <div class="col-md-2 stretch-card grid-margin">
                <div class="card ">
                  <div class="card-body">
                    <img src="" class="card-img-absolute" alt="" />
                    <p >N° de Referencia Pago: *numreferenciapago*</p>
                    <h4 class="font-weight-normal mb-3">Monto Pagado: *monto pagado*<i class="mdi mdi-chart-line mdi-24px float-end"></i>
                    </h4>
                    <p class="font-weight-normal">Fecha: *Fecha*</p>
                  </div>
                </div>
              </div>
        </div>
<p>Monto Pendiente: *Monto Pendiente*</p>
<hr>
<label for="estado"> <h4> Estado de factura</h4></label>
<select name="estado" id="" class="form-select">
    <option value="PENDIENTE">Pendiente</option>
    <option value="COMPLETO">Completo</option>
</select>
<br>
<button type="submit" class="btn btn-success">Actualizar Estado Factura</button>
<br>

<p class="font-weight-bold text-uppercase px-3 small mt-3 mb-0">Otras Acciones</p>
<button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="{{ Route('adminpagos')}}" style="text-decoration: none; color: white;">Ir a Admin Pagos</a></button>
</form>
</div>
<x-footeradmin></x-footeradmin>