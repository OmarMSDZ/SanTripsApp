<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de admin vehiculos -->
<h2>Admin Vehiculos Transporte<span class="text-gray float-end">SanTrips</span></h2>
<hr>

<div class="row d-flex">
    <!-- Formulario -->
    <div class="col-md-6">
        <form action="" method="POST" class="form">
        <div class="mb-3">
                <label for="matricula" class="form-label">Matricula</label>
                <input type="text" name="matricula" class="form-control" placeholder="Matricula del Vehículo">
            </div>
            <div class="mb-3">
                <label for="marcavehiculo" class="form-label">Marca Vehículo</label>
                <select name="marcavehiculo" id="" class="form-select">
                    <option value="1">Traer de BD</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="modelovehiculo" class="form-label">Modelo Vehículo</label>
                <select name="modelovehiculo" id="" class="form-select">
                    <option value="1">Traer de BD</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tipovehiculo" class="form-label">Tipo Vehículo</label>
                <select name="tipovehiculo" id="" class="form-select">
                    <option value="1">Traer de BD</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="fechaingreso" class="form-label">Fecha Ingreso</label>
                <input type="date" name="fechaingreso" class="form-control">
            </div>
            <div class="mb-3">
                <label for="cantpasajeros" class="form-label">Cantidad Pasajeros</label>
                <input type="number" name="cantpasajeros" class="form-control" placeholder="Cantidad Pasajeros">
            </div>

            <div class="mb-3">
                <label for="anovehiculo" class="form-label">Año del vehículo</label>
                <input  name="anovehiculo" type="number" class="form-control" min="1990" max="2100" step="1" placeholder="Año del vehiculo"/>
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Color del vehículo</label>
                <input type="text" name="color" class="form-control" placeholder="Color del vehiculo">
            </div>
            <div class="mb-3">
                <label for="tipocombustible" class="form-label">Tipo Combustible</label>
                <select name="tipocombustible" id="" class="form-select">
                    <option value="Gasolina">Gasolina</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Gas Natural">Gas Natural</option>
                    <option value="Eléctrico">Eléctrico</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="" class="form-select">
                    <option value="ACTIVO">Activo</option>
                    <option value="INACTIVO">Inactivo</option>
                </select>
            </div>
            
            <div class="mb-3">
                <button type="button" class="btn btn-success">Registrar</button>
                <button type="button" class="btn btn-warning">Actualizar</button>
                <br>
                <p class="font-weight-bold text-uppercase px-3 small mt-3 mb-0">Otras Acciones</p>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="adminmarcasvehiculos.php" style="text-decoration: none; color: white;"> Administrar Marcas</a></button>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="adminmodelosvehiculos.php" style="text-decoration: none; color: white;"> Administrar Modelos</a></button>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="admintiposvehiculo.php" style="text-decoration: none; color: white;"> Administrar Tipos</a></button>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="asignarvehiculoempleado.php" style="text-decoration: none; color: white;"> Asignar Vehículo Empleado</a></button>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="asignarvehiculopaquete.php" style="text-decoration: none; color: white;"> Asignar Vehículo Paq.</a></button>
            </div>
        </form>
    </div>

    
    <!-- Tabla de consulta -->
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

    <div class="col-md-6 table-container">
        <table class="table table-hover">
            <!-- Contenido de la tabla -->
            <thead class="">
            <tr>
                <th>Id</th>
                <th>Matricula</th>
                <th>Descripcion</th>
                <th>Fecha Ingreso</th>
                <th>Cantidad Pasajeros</th>
                <th>Año Vehículo</th>
                <th>Color</th>
                <th>Tipo Combustible</th>
                <th>Marca Vehículo</th>
                <th>Modelo Vehículo</th>
                <th>Tipo Vehículo</th>
                <th>Estado</th>
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