<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de admin ofertas -->
<h2>Admin Ofertas <span class="text-gray float-end">SanTrips</span></h2>
<hr>

<div class="row d-flex">
    <!-- Formulario -->
    <div class="col-md-6">

        {{-- Esto nos permite utilizar este mismo formulario para crear y editar --}}
        @if (isset($ofertas))
        <h2>Editar Oferta</h2>
        @else
        <h2>Crear Oferta</h2>
        @endif

        {{-- En caso de que hayan registros enviados en la variable cliente, se transformara el formulario
            en uno de actualizar y con el metodo PUT, en caso de que no, en uno de crear --}}
        @if (isset($ofertas))
        <form action="{{route('Ofertas.update', $ofertas)}}" method="post">
            @method('PUT')
        @else
        <form action="{{route('Ofertas.store')}}" method="post">
        @endif
            @csrf
            <div class="mb-3">
                <label for="Descripcion" class="form-label">Descripción de la Oferta</label>
                <textarea name="Descripcion" id="" cols="30" rows="10" class="form-control" placeholder="Descripcion de la oferta" value="{{old('Descripcion') ?? @$ofertas->Descripcion}}"></textarea>  
                @error('Descripcion')
                <p class="text-danger form-text">{{$message}}</p>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="Porcentaje" class="form-label">Porcentaje (%)</label>
                <input type="number" name="Porcentaje" class="form-control" placeholder="Ingrese el porcentaje (En numeros enteros)" value="{{old('Porcentaje') ?? @$ofertas->Porcentaje}}">
                @error('Porcentaje')
                <p class="text-danger form-text">{{$message}}</p>
                @enderror
            </div>
             
            <div class="mb-3">
                <label for="FechaDesde" class="form-label">Disponible Desde</label>
                <input type="date" name="FechaDesde" class="form-control" placeholder="Seleccione una fecha" value="{{old('FechaDesde') ?? @$ofertas->FechaDesde}}">
                @error('FechaDesde')
                <p class="text-danger form-text">{{$message}}</p>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="FechaHasta" class="form-label">Disponible Hasta</label>
                <input type="date" name="FechaHasta" class="form-control" placeholder="Seleccione una fecha" value="{{old('FechaHasta') ?? @$ofertas->FechaHasta}}">
                @error('FechaHasta')
                <p class="text-danger form-text">{{$message}}</p>
                @enderror
            </div>
            
            <div class="mb-3">
                @if (isset($ofertas))
                <button type="button submit" class="btn btn-success">Actualizar</button>
                @else
                <button type="button submit" class="btn btn-success">Guardar</button>
                @endif
                <br>
                <p class="font-weight-bold text-uppercase px-3 small mt-3 mb-0">Otras Acciones</p>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="{{ Route('adminpaquetes')}}"  style="text-decoration: none; color: white;">Volver a Admin Paquetes</a></button>
            </div>
        </form>
    </div>
 
   
</div>
</div>
<x-footeradmin></x-footeradmin>