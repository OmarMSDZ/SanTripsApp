<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de asignar destinos a paquetes -->
<h2>Asignar Destinos a Paquetes <span class="text-gray float-end">SanTrips</span></h2>
<hr>
<div class="row d-flex">
    <!-- Formulario -->
    <div class="col-md-6">
        <form action="" method="POST" class="form">

            <div class="mb-3">
                    <label for="destino" class="form-label">Destino</label>
                    <select name="destino" id="" class="form-select">
                        <option value="1">Traer de BD</option>
                    </select>
            </div>
            <div class="mb-3">
                    <label for="paquete" class="form-label">Paquete</label>
                    <select name="paquete" id="" class="form-select">
                        <option value="1">Traer de BD</option>
                    </select>
            </div>

            
            <div class="mb-3">
                <button type="button submit" name="save" class="btn btn-success">Registrar</button>
                <button type="button submit" name="update" class="btn btn-warning">Actualizar</button>
                <br>
                <p class="font-weight-bold text-uppercase px-3 small mt-3 mb-0">Otras Acciones</p>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="admindestinos.php" style="text-decoration: none; color: white;"> Volver a Admin Destinos</a></button>
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
                    <th>Destino</th>
                    <th>Paquete</th>
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