<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de admin usuarios -->
<h2>Admin Usuarios <span class="text-gray float-end">SanTrips</span></h2>
<hr>
<div class="row d-flex">
    <!-- Formulario -->
    <div class="col-md-6">
        <form action="" method="POST" class="form">
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombre/s del usuario</label>
                <input type="text" name="nombres" class="form-control" placeholder="Nombre/s">
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellido/s del usuario</label>
                <input type="text" name="apellidos" class="form-control" placeholder="Apellido/s">
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre de usuario (Recomendable que sea diferente al real)</label>
                <input type="text" name="usuario" class="form-control" placeholder="Nombre de usuario">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono del usuario</label>
                <input type="text" name="telefono" class="form-control" placeholder="Teléfono">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email del usuario</label>
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="Contraseña">
            </div>
            <div class="mb-3">
                <label for="passwordconf" class="form-label">Confirmar Contraseña</label>
                <input type="password" name="passwordconf" class="form-control" placeholder="Confirmar Contraseña">
            </div>
            <div class="mb-3">
                <label for="preferenciasviaje" class="form-label">Preferencias de viaje</label>
                <select name="preferenciasviaje" id="" class="form-select">
                    <option value="1">Prueba 1</option>
                    <option value="2">Prueba 2</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Nivel de acceso</label>
                <select name="role" id="" class="form-select">
                    <option value="USER">Usuario Normal</option>
                    <option value="ADMIN">Usuario Administrador</option>
                </select>
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-success">Registrar</button>
                <button type="button" class="btn btn-warning">Actualizar</button>
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
                <th>Nombre/s</th>
                <th>Apellido/s</th>
                <th>Nombre de Usuario</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Preferencias Viaje</th>
                <th>Tipo de Usuario</th>
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