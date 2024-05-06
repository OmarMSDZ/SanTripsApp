<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de admin paquetes -->
<h2>Admin Paquetes <span class="text-gray float-end">SanTrips</span></h2>
<hr>
<div class="row d-flex">
    <!-- Formulario -->
    <div class="col-md-6">
        <form action="" method="POST" class="form">
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombre del paquete</label>
                <input type="text" name="nombres" class="form-control" placeholder="Nombre del paquete">
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <textarea name="descripcion" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="costo" class="form-label">Costo (RD$)</label>
                <input type="number" name="costo" class="form-control" placeholder="Ingrese el costo en RD$">
            </div>
            <div class="mb-3">
                <label for="numpersonas" class="form-label">Numero de Personas</label>
                <input type="number" name="numpersonas" class="form-control" placeholder="Ingrese el numero maximo de personas que asistirán">
            </div>
            <div class="mb-3">
                <label for="edades" class="form-label">Edades</label>
                <select name="edades" id="" class="form-select">
                    <option value="Todas las edades">Todas las edades</option>
                    <option value="Mayores de 14 años">Mayores de 16 años</option>
                    <option value="Solo Adultos">Solo Adultos</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="alojamiento" class="form-label">Alojamiento</label>
                <select name="alojamiento" id="" class="form-select">
                    <option value="Disponible (Hotel)">Disponible (Hotel)</option>
                    <option value="Disponible (A especificar)">Disponible (A especificar)</option>
                    <option value="No Disponible">No Disponible</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tiempoestimado" class="form-label">Tiempo Estimado (En Horas)</label>
                <input type="number" name="tiempoestimado" class="form-control" placeholder="Ingrese el Tiempo Estimado">
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <select name="categoria" id="" class="form-select">
                    <option value="1">Traer de BD</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="ofertas" class="form-label">Ofertas Aplicadas</label>
                <select name="ofertas" id="" class="form-select">
                    <option value="1">Traer de BD</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="disponibilidad" class="form-label">Disponibilidad</label>
                <select name="disponibilidad" id="" class="form-select">
                    <option value="Disponible">Disponible</option>
                    <option value="No Disponible">No Disponible</option>
                </select>
            </div>
            <div class="mb-3">
                <button type="button submit" name="save" class="btn btn-success">Registrar</button>
                <button type="button submit" name="update" class="btn btn-warning">Actualizar</button>
                <br>
                <p class="font-weight-bold text-uppercase px-3 small mt-3 mb-0">Otras Acciones</p>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="adminimagenespaquetes.php" style="text-decoration: none; color: white;"> Asignar Imagenes</a></button>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="admincategoriapaquetes.php" style="text-decoration: none; color: white;"> Administrar Categorías</a></button>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="adminofertas.php" style="text-decoration: none; color: white;"> Administrar Ofertas</a></button>
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
                    <th>Descripcion</th>
                    <th>Costo</th>
                    <th>N° Personas</th>
                    <th>Edades</th>
                    <th>Idiomas</th>
                    <th>Alojamiento</th>
                    <th>Tiempo Estimado (H)</th>
                    <th>Categoria</th>
                    <th>Ofertas</th>
                    <th>Disponibilidad</th>
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