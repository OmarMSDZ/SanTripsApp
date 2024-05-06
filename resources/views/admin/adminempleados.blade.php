<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de admin empleados -->
<h2>Admin Empleados <span class="text-gray float-end">SanTrips</span></h2>
<hr>

<div class="row d-flex">
    <!-- Formulario -->
    <div class="col-md-6">
        <form action="" method="POST" class="form">
        <div class="mb-3">
                <label for="cedula" class="form-label">Cédula o Documento de Identidad</label>
                <input type="text" name="cedula" class="form-control" placeholder="Cedula del empleado">
            </div>
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombre/s</label>
                <input type="text" name="nombres" class="form-control" placeholder="Nombre/s">
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellido/s</label>
                <input type="text" name="apellidos" class="form-control" placeholder="Apellido/s">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" name="telefono" class="form-control" placeholder="Teléfono">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="mb-3">
                <label for="licencia" class="form-label">N° Licencia de Conducir</label>
                <input type="text" name="licencia" class="form-control" placeholder="Licencia de Conducir">
            </div>
            <div class="mb-3">
                <label for="cargo" class="form-label">Cargo</label>
                <select name="cargo" id="" class="form-select">
                    <option value="1">Traer de BD</option> 
                </select>
            </div>
            <div class="mb-3">
                <label for="fechaingreso" class="form-label">Fecha Ingreso</label>
                <input type="date" name="fechaingreso" class="form-control">
            </div>
            <div class="mb-3">
                <label for="fechasalida" class="form-label">Fecha Salida</label>
                <input type="date" name="fechasalida" class="form-control" >
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
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="{{ Route('admincargospuestos')}}" style="text-decoration: none; color: white;"> Administrar Cargos</a></button>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="{{ Route('asignarencargadopaquete')}}" style="text-decoration: none; color: white;"> Asignar Encargado Paquete</a></button>
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
                <th>Cédula</th>
                <th>Nombre/s</th>
                <th>Apellido/s</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Lic. Conducir</th>
                <th>Cargo/Puesto</th>
                <th>Fecha Ingreso</th>
                <th>Fecha Salida</th>
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