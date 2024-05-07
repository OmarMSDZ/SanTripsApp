<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de admin empresas proveedoras -->
<h2>Admin Empresas Proveedoras <span class="text-gray float-end">SanTrips</span></h2>
<hr>

<div class="row d-flex">
    <!-- Formulario -->
    <div class="col-md-6">
        <form action="" method="POST" class="form">
            <div class="mb-3">
                <label for="nombreempresa" class="form-label">Nombre</label>
                <input type="text" name="nombreempresa" class="form-control" placeholder="Nombre de la Empresa">
            </div>
            <div class="mb-3">
                <label for="telefonoempresa" class="form-label">Telefono</label>
                <input type="tel" name="telefonoempresa" class="form-control" placeholder="Telefono de la empresa">
            </div>
            <div class="mb-3">
                <label for="emailempresa" class="form-label">Email</label>
                <input type="email" name="emailempresa" class="form-control" placeholder="Email de la empresa">
            </div>
            <div class="mb-3">
                <label for="provincia" class="form-label">Provincia</label>
                <select name="provincia" id="" class="form-select">
                    <option value="1">Traer de BD</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="direccionempresa" class="form-label">Dirección</label>
                <input type="text" name="direccionempresa" class="form-control" placeholder="Dirección de la empresa">
            </div>
            <div class="mb-3">
                <label for="tipoempresa" class="form-label">Tipo de Servicio Ofrecido</label>
                <select name="tipoempresa" id="" class="form-select">
                    <option value="1">Traer de BD</option>
                </select>
            </div>
             
            <div class="mb-3">
                <button type="button submit" name="save" class="btn btn-success">Registrar</button>
                <button type="button submit" name="update" class="btn btn-warning">Actualizar</button>
                <br>
                <p class="font-weight-bold text-uppercase px-3 small mt-3 mb-0">Otras Acciones</p>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="{{ Route('adminprovincias')}}"  style="text-decoration: none; color: white;"> Administrar Provincias</a></button>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="{{ Route('admintiposerviciosprov')}}"  style="text-decoration: none; color: white;"> Administrar Tipos de Servicio</a></button>
                 
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
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Provincia</th>
                    <th>Dirección</th>
                    <th>Tipo de Servicio</th>
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