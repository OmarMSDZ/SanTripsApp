<x-headadmin></x-headadmin>
<!-- Contenido de admin pagos -->
<div class="page-content p-5" id="content">
<h2>Admin Pagos <span class="text-gray float-end">SanTrips</span></h2>
<hr>

<h2></h2>
<h3>Mostrar Por Estado de Pago Factura:</h3>
<select name="clasificacion" id="clasificacion" class="form-select">
    <option value="PENDIENTE">Pendiente</option>
    <option value="COMPLETADO">Completado</option>
</select>
<!-- Aqui va de forma dinamica cada pago, ya sea pendiente o no del usuairo -->
<div class="row my-5">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card ">
                  <div class="card-body">
                    <img src="" class="card-img-absolute" alt="" />
                    <p hidden>*id factura*</p>
                    <h4 class="font-weight-normal mb-3">*monto pendiente*<i class="mdi mdi-chart-line mdi-24px float-end"></i>
                    </h4>
                    <p class="font-weight-normal">*Fecha ultimo pago*</p>
                    <p class="mb-5">Estatus: *Estatus de pago factura*</p>
                    <!-- Aqui debería enviar con el id del incidente seleccionado a esta pagina -->
                    <h6 class="card-text"><a href="vistadetalladapago.php" style="text-decoration: none; color: black;">Vista Detallada</a></h6>
                  </div>
                </div>
              </div>
        </div>
</div>
 
        <x-footeradmin></x-footeradmin>