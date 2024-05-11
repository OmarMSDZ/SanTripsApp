<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de admin categorias paquetes -->
<h2>Admin Categorías Paquetes <span class="text-gray float-end">SanTrips</span></h2>
<hr>

<div class="row d-flex">
    <!-- Formulario -->
    <div class="">
        {{-- Esto nos permite utilizar este mismo formulario para crear y editar --}}
        @if (isset($categorias_paquetes))
        <h2>Editar Categoria</h2>
        @else
        <h2>Crear Categoria</h2>
        @endif

        {{-- En caso de que hayan registros enviados en la variable cliente, se transformara el formulario
            en uno de actualizar y con el metodo PUT, en caso de que no, en uno de crear --}}
        @if (isset($categorias_paquetes))
        <form action="{{route('Categorias_paquetes.update', $categorias_paquetes)}}" method="post">
            @method('PUT')
        @else
        <form action="{{route('Categorias_paquetes.store')}}" method="post">
        @endif

        @csrf
            <div class="mb-3">
                <label for="Categoriapaq" class="form-label" style="font-weight: bold">Nombre de Categoría</label>
                <input type="text" name="Categoriapaq" class="form-control" placeholder="Nombre de la Categoría" value="{{old('Categoriapaq') ?? @$categorias_paquetes->Categoriapaq}}">
                @error('Categoriapaq')
                    <p class="text-danger form-text">{{$message}}</p>
                @enderror
            </div>
             
            <div class="mb-3">

                @if (isset($categorias_paquetes))
                <button type="button submit" class="btn btn-success">Actualizar</button>
                @else
                <button type="button submit" class="btn btn-success">Guardar</button>
                @endif

                
                <br>
                <p class="font-weight-bold text-uppercase px-3 small mt-3 mb-0">Otras Acciones</p>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="{{ Route('adminpaquetes')}}" style="text-decoration: none; color: white;">Volver a Admin Paquetes</a></button>
              </div>
        </form>
    </div>

   
</div>
</div>
<x-footeradmin></x-footeradmin>