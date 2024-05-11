<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de admin ofertas -->
<h2>Admin Ofertas <span class="text-gray float-end">SanTrips</span></h2>
<hr>
 <h3>Ofertas Registradas</h3>
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
                    <th>Descripcion</th>
                    <th>Porcentaje (%)</th>
                    <th>Disponible Desde</th>
                    <th>Disponible Hasta</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                    @forelse ($ofertas as $oferta)
                        
                    <tr>
                        <td>{{$oferta->IdOferta}}</td>
                        <td>{{$oferta->Descripcion}}</td>
                        <td>{{$oferta->Porcentaje}}</td>
                        <td>{{$oferta->FechaDesde}}</td>
                        <td>{{$oferta->FechaHasta}}</td>
                        
                        <td>
                            {{-- Boton de actualizar --}}
                      <a href="{{route('Ofertas.edit', $oferta->IdOferta)}}" class="btn btn-warning">Editar</a>
                      {{-- Boton de eliminar, se tiene que hacer por post obligatoriamente y con su metodo delete--}}
                      <form action="{{route('Ofertas.destroy', $oferta->IdOferta)}}" method="post" class="d-inline">
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
    </div>

    {{-- Mensajes de alerta --}}
    @if (Session::has('mensaje'))
    <div class="alert alert-info my-5">
        {{Session::get('mensaje')}}
    </div>
    @endif

    <a href="{{route('Ofertas.create')}}" class="btn btn-success">Ingresar Nuevo</a>


</div>
</div>
<x-footeradmin></x-footeradmin>