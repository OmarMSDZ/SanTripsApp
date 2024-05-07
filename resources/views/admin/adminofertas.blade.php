<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de admin ofertas -->
<h2>Admin Ofertas <span class="text-gray float-end">SanTrips</span></h2>
<hr>

<div class="row d-flex">
    <!-- Formulario -->
    <div class="col-md-6">
        <form action="" method="POST" class="form">
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción de la Oferta</label>
                <textarea name="descripcion" id="" cols="30" rows="10" class="form-control" placeholder="Descripcion de la oferta"></textarea>  
            </div>
            <div class="mb-3">
                <label for="porcentaje" class="form-label">Porcentaje (%)</label>
                <input type="number" name="porcentaje" class="form-control" placeholder="Ingrese el porcentaje (En numeros enteros)">
            </div>
             
            <div class="mb-3">
                <label for="fechadesde" class="form-label">Disponible Desde</label>
                <input type="date" name="fechadesde" class="form-control" placeholder="Seleccione una fecha">
            </div>
            
            <div class="mb-3">
                <label for="fechahasta" class="form-label">Disponible Hasta</label>
                <input type="date" name="fechahasta" class="form-control" placeholder="Seleccione una fecha">
            </div>
            
            <div class="mb-3">
                <button type="button submit" name="save" class="btn btn-success">Registrar</button>
                <button type="button submit" name="update" class="btn btn-warning">Actualizar</button>
                <br>
                <p class="font-weight-bold text-uppercase px-3 small mt-3 mb-0">Otras Acciones</p>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="{{ Route('adminpaquetes')}}"  style="text-decoration: none; color: white;">Volver a Admin Paquetes</a></button>
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
                    <th>Descripcion</th>
                    <th>Porcentaje (%)</th>
                    <th>Disponible Desde</th>
                    <th>Disponible Hasta</th>
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