<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de admin destinos -->
<h2>Admin Destinos <span class="text-gray float-end">SanTrips</span></h2>
<hr>
<div class="row d-flex">
    <!-- Formulario -->
    <div class="col-md-6">
        <form action="" method="POST" class="form">
            <div class="mb-3">
                <label for="nombredestino" class="form-label">Nombre del Destino</label>
                <input type="text" name="nombredestino" class="form-control" placeholder="Nombre del destino">
            </div>
            <div class="mb-3">
                <label for="empresaprovdestino" class="form-label">Empresa</label>
                <select name="empresaprovdestino" id="" class="form-select">
                    <option value="1">Traer de BD</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tipodestino" class="form-label">Tipo de Destino</label>
                <select name="tipodestino" id="" class="form-select">
                    <option value="1">Traer de BD</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="provincia" class="form-label">Provincia</label>
                <select name="provincia" id="" class="form-select">
                    <option value="1">Traer de BD</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="horariodesde" class="form-label">Abierto Desde</label>
                <input type="time" name="horariodesde" class="form-control">
            </div>
            <div class="mb-3">
                <label for="horariodesde" class="form-label">Abierto Hasta</label>
                <input type="time" name="horariodesde" class="form-control">
            </div>

            <div class="mb-3">
                <label for="obervaciones" class="form-label">Observaciones</label>
                <textarea name="observaciones" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <button type="button submit" name="save" class="btn btn-success">Registrar</button>
                <button type="button submit" name="update" class="btn btn-warning">Actualizar</button>
                <br>
                <p class="font-weight-bold text-uppercase px-3 small mt-3 mb-0">Otras Acciones</p>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="{{ Route('adminprovincias')}}"  style="text-decoration: none; color: white;"> Administrar Provincias</a></button>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="{{ Route('admintiposdestino')}}"  style="text-decoration: none; color: white;"> Administrar Tipos</a></button>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="{{ Route('asignardestinospaquetes')}}"  style="text-decoration: none; color: white;">Asignar a Paquete</a></button>
            </div>
        </form>
    </div>

    <style>
  .table-container {
  
    overflow-x: auto; /* Activar la barra de desplazamiento horizontal si es necesario */
    overflow-y: auto; /* Activar la barra de desplazamiento vertical si es necesario */
  }
  table {
    width: 100%; /* Para que la tabla ocupe todo el ancho del contenedor */
    border-collapse: collapse;
  }
  th, td {
   
    padding: 8px;
    text-align: left;
  }
  th {
    background-color: #f2f2f2;
  }
</style>

    <!-- Tabla de consulta -->
    <div class="col-md-6 table-container">
        <table class="table table-hover">
            <!-- Contenido de la tabla -->
            <thead class="">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Provincia</th>
                    <th>Abierto Desde</th>
                    <th>Abierto Hasta</th>
                    <th>Observaciones</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
</div>
<x-footeradmin></x-footeradmin>