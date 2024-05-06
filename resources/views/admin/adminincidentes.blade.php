<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de admin incidentes -->
<h2>Admin Incidentes <span class="text-gray float-end">SanTrips</span></h2>
<hr>
<h2>Incidentes Reportados</h2>
<h3>Mostrar Incidentes Por Estado:</h3>
<select name="clasificacion" id="clasificacion" class="form-select">
    <option value="PENDIENTE">Pendiente</option>
    <option value="EN PROCESO">En Proceso</option>
    <option value="COMPLETADOS">Completados</option>
</select>
<!-- esto desde aqui va de forma dinamica, para mostrar una tarjeta con una descripcion breve del incidente ocurrido, y un link para proceder a otra pagina donde se detallará mas el incidente -->
<!-- Todo lo que está en asteriscos es informacion dinámica de cada incidente, por cada incidente debe de generarse una tarjeta igual que esta -->
<!-- El formulario para reportar los incidentes está del lado del cliente y no en admin -->
<!-- Se mostraran por categorias, las cuales se basaran en el estado, ya sea pendientes, en proceso y completado-->
<div class="row my-5">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card ">
                  <div class="card-body">
                    <img src="" class="card-img-absolute" alt="" />
                    <p hidden>*id*</p>
                    <h4 class="font-weight-normal mb-3">*Descripcion del incidente*<i class="mdi mdi-chart-line mdi-24px float-end"></i>
                    </h4>
                    <p class="font-weight-normal">*Fecha del incidente*</p>
                    <p class="mb-5">Estatus: *Estatus del incidente*</p>
                    <!-- Aqui debería enviar con el id del incidente seleccionado a esta pagina -->
                    <h6 class="card-text"><a href="vistadetalladaincidente.php" style="text-decoration: none; color: black;">Vista Detallada</a></h6>
                  </div>
                </div>
              </div>
        </div>
</div>
 
        <x-footeradmin></x-footeradmin>