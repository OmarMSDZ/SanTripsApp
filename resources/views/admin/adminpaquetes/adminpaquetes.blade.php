<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de admin paquetes -->
<h2>Admin Paquetes <span class="text-gray float-end">SanTrips</span></h2>
<hr>
<h3>Paquetes Registrados</h3>
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
    <div class=" table-container">
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

                @forelse ($paquetes_turisticos as $paquete)
                        
                <tr>
                    <td>{{$paquete->IdPaquete}}</td>
                    <td>{{$paquete->Nombre}}</td>
                    <td>{{$paquete->Descripcion}}</td>
                    <td>{{$paquete->Costo}}</td>
                    <td>{{$paquete->Num_personas}}</td>
                    <td>{{$paquete->Edades}}</td>
                    <td>{{$paquete->Idiomas}}</td>
                    <td>{{$paquete->Alojamiento}}</td>
                    <td>{{$paquete->Tiempo_estimado}}</td>
                    <td>{{$paquete->Disponibilidad}}</td>
                    <td>{{$paquete->Categoria}}</td>
                    <td>{{$paquete->Descoferta}}</td>
                    
                    
                    
                    <td>
                        {{-- Boton de actualizar --}}
                  <a href="{{route('Paquetes.edit', $paquete->IdPaquete)}}" class="btn btn-warning">Editar</a>
                  {{-- Boton de eliminar, se tiene que hacer por post obligatoriamente y con su metodo delete--}}
                  <form action="{{route('Paquetes.destroy', $paquete->IdPaquete)}}" method="post" class="d-inline">
                  @method('DELETE')
                  @csrf
                  {{-- El boton tambien valida antes de eliminar --}}
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Esta seguro de eliminar este registro?')">Eliminar</button>
                  </form>

                    </td>
                </tr>
                @empty
                    <tr><td colspan="6" class="text-danger"> <center> No se encuentran registros</center></td></tr>
                @endforelse


            </tbody>
        </table>
         {{-- Para la paginacion de la tabla, se valida si hay o no registros antes de  --}}
         @if ($paquetes_turisticos->count())
         {{$paquetes_turisticos->links()}}    
         @endif

    </div>
    {{-- Mensajes de alerta --}}
    @if (Session::has('mensaje'))
    <div class="alert alert-info my-5">
        {{Session::get('mensaje')}}
    </div>
    @endif

    <a href="{{route('Paquetes.create')}}" class="btn btn-success">Ingresar Nuevo</a>

</div>
</div>
<x-footeradmin></x-footeradmin>