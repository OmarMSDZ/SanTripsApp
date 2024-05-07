<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de admin incidentes -->
<h2>Admin Incidentes <span class="text-gray float-end">SanTrips</span></h2>
<h3>Vista Detallada</h3>
<hr>

<!-- Todo lo que está en asteriscos es informacion dinámica de cada incidente, por cada incidente debe de generarse una tarjeta igual que esta -->
<!--La informacion de cada incidente se tomara del id de la tarjeta seleccionada en la vista de los incidentes-->
<form action="" method="POST" class="form">

<input name="idincidente" type="text" class="form-control" hidden>
<h2>Reportado por: *Usuario*</h2> 
<p>*Tipo de incidente*</p>
<p>*Fecha*</p>
<p>*Descripcion*</p>
<hr>
<label for="estado"> <h4> Estado del Incidente</h4></label>
<select name="estado" id="" class="form-select">
    <option value="PENDIENTE">Pendiente</option>
    <option value="EN PROCESO">En Proceso</option>
    <option value="RESUELTO">Resuelto</option>
</select>
<br>
<button type="submit" class="btn btn-success">Actualizar Estado Incidente</button>
<br>

<p class="font-weight-bold text-uppercase px-3 small mt-3 mb-0">Otras Acciones</p>
<button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="{{ Route('adminincidentes')}}"  style="text-decoration: none; color: white;">Ir a Admin Incidentes</a></button>
</form>
</div>
<x-footeradmin></x-footeradmin>