<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de admin categorias paquetes -->
<h2>Admin Categorías Paquetes <span class="text-gray float-end">SanTrips</span></h2>
<hr>
<h2>Categorías Paquetes</h2>
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
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
              @forelse ($categoriaspaquetes as $categoriaspaquete)
                  <tr>
                    <td>{{$categoriaspaquete->IdCategoriapaq}}</td>
                    <td>{{$categoriaspaquete->Categoriapaq}}</td>
                    <td>
                      {{-- Boton de actualizar --}}
                      <a href="{{route('Categorias_paquetes.edit', $categoriaspaquete->IdCategoriapaq)}}" class="btn btn-warning">Editar</a>
                      {{-- Boton de eliminar, se tiene que hacer por post obligatoriamente y con su metodo delete--}}
                      <form action="{{route('Categorias_paquetes.destroy', $categoriaspaquete->IdCategoriapaq)}}" method="post" class="d-inline">
                      @method('DELETE')
                      @csrf
                      {{-- El boton tambien valida antes de eliminar --}}
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Esta seguro de eliminar este registro?')">Eliminar</button>
                      </form>
                      
                    </td>
                    
                  </tr>
                  @empty
                  <tr><td colspan="3" class="text-danger"> <center> No se encuentran registros</center></td></tr>
              @endforelse
            </tbody>
        </table>
         {{-- Para la paginacion de la tabla, se valida si hay o no registros antes de  --}}
         @if ($categoriaspaquetes->count())
         {{$categoriaspaquetes->links()}}    
         @endif
    </div>
    {{-- Mensajes de alerta --}}
    @if (Session::has('mensaje'))
    <div class="alert alert-info my-5">
        {{Session::get('mensaje')}}
    </div>
    @endif

    <a href="{{route('Categorias_paquetes.create')}}" class="btn btn-success">Ingresar Nuevo</a>

</div>
</div>
<x-footeradmin></x-footeradmin>