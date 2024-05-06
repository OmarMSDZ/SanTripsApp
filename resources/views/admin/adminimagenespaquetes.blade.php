<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de la pagina de admin imagenes paquetes -->
<h2>Admin Imagenes Paquetes <span class="text-gray float-end">SanTrips</span></h2>
<hr>
<div class="row d-flex">
    <!-- Formulario -->
    <div class="col-md-6">
        <form action="" method="POST" class="form">
        <div class="mb-3">
                <label for="imagen" class="form-label">Imagen a Asignar</label>
                <input type="file" name="imagen" class="form-control" placeholder="Suba la imagen a asignar al paquete">
            </div>   
        <div class="mb-3">
                <label for="paquete" class="form-label">Asignar a</label>
                <select name="paquete" id="" class="form-select">
                    <option value="1">Traer de BD</option>
                </select>
        </div>

            <div class="mb-3">
                <button type="button submit" name="save" class="btn btn-success">Asignar a paquete</button>
                <button type="button submit" name="update" class="btn btn-warning">Actualizar</button>
                <br>
                <p class="font-weight-bold text-uppercase px-3 small mt-3 mb-0">Otras Acciones</p>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="adminpaquetes.php" style="text-decoration: none; color: white;">Volver a Admin Paquetes</a></button>
            </div>
        </form>
    </div>

    <!-- Tabla de consulta -->
     <!-- Tabla de consulta -->
     <div class="col-md-6">
        <table class="table table-hover">
            <!-- Contenido de la tabla -->
            <thead class="">
                <tr>
                    <th>Id Paquete</th>
                    <th>Paquete</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
</div>
<x-footeradmin></x-footeradmin>
