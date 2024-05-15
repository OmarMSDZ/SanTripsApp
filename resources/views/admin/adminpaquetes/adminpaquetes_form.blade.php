<x-headadmin></x-headadmin>
<div class="page-content p-5" id="content">
<!-- Contenido de admin paquetes -->
<h2>Admin Paquetes <span class="text-gray float-end">SanTrips</span></h2>
<hr>
<div class="row d-flex">
    <!-- Formulario -->
    <div class="">
          {{-- Esto nos permite utilizar este mismo formulario para crear y editar --}}
          @if (isset($paquetes_turisticos))
          <h2>Editar Paquete Turistico</h2>
          @else
          <h2>Crear Paquete Turistico</h2>
          @endif

          {{-- En caso de que hayan registros enviados en la variable, se transformara el formulario
              en uno de actualizar y con el metodo PUT, en caso de que no, en uno de crear --}}
          @if (isset($paquetes_turisticos))
          <form action="{{route('Paquetes.update', $paquetes_turisticos)}}" method="post">
              @method('PUT')
          @else
          <form action="{{route('Paquetes.store')}}" method="post">
          @endif
              @csrf
            <div class="mb-3">
                <label for="Nombre" class="form-label" style="font-weight: bold">Nombre del paquete</label>
                <input type="text" name="Nombre" class="form-control" placeholder="Nombre del paquete" value="{{old('Nombre') ?? @$paquetes_turisticos->Nombre}}">
            </div>
            <div class="mb-3">
                <label for="Descripcion" class="form-label" style="font-weight: bold">Descripcion</label>
                <textarea name="Descripcion" id="" cols="30" rows="10" class="form-control" value="{{old('Descripcion') ?? @$paquetes_turisticos->Descripcion}}"></textarea>
            </div>
            <div class="mb-3">
                <label for="Costo" class="form-label" style="font-weight: bold">Costo (RD$)</label>
                <input type="number" name="Costo" class="form-control" placeholder="Ingrese el costo en RD$" value="{{old('Costo') ?? @$paquetes_turisticos->Costo}}">
            </div>
            <div class="mb-3">
                <label for="Num_personas" class="form-label" style="font-weight: bold">Numero de Personas</label>
                <input type="number" name="Num_personas" class="form-control" placeholder="Ingrese el numero maximo de personas que asistirán" value="{{old('Numero_personas') ?? @$paquetes_turisticos->Numero_personas}}">
            </div>
            <div class="mb-3">
                <label for="Edades" class="form-label" style="font-weight: bold">Edades</label>
                <select name="Edades" id="" class="form-select">
                    <option value="Todas las edades">Todas las edades</option>
                    <option value="Mayores de 14 años">Mayores de 16 años</option>
                    <option value="Solo Adultos">Solo Adultos</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="Idiomas" class="form-label" style="font-weight: bold">Idiomas</label>
                <select name="Idiomas" id="" class="form-select">
                    <option value="Español">Español</option>
                    <option value="Ingles">Ingles</option>
                    <option value="Ambos">Ambos</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="Alojamiento" class="form-label" style="font-weight: bold">Alojamiento</label>
                <select name="Alojamiento" id="" class="form-select">
                    <option value="Disponible (Hotel)">Disponible (Hotel)</option>
                    <option value="Disponible (A especificar)">Disponible (A especificar)</option>
                    <option value="No Disponible">No Disponible</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="Tiempo_estimado" class="form-label" style="font-weight: bold">Tiempo Estimado (En Horas)</label>
                <input type="number" name="Tiempo_estimado" class="form-control" placeholder="Ingrese el Tiempo Estimado" value="{{old('Tiempo_estimado') ?? @$paquetes_turisticos->Tiempo_estimado}}">
            </div>
            <div class="mb-3">
                <label for="Categoria" class="form-label" style="font-weight: bold">Categoría</label>
                <select name="Categoria" id="" class="form-select">
                    @php
                        $categorias = DB::select('select * from categorias_paquetes')
                    @endphp

                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->IdCategoriapaq}}">{{$categoria->Categoriapaq}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="Ofertas" class="form-label" style="font-weight: bold">Ofertas Aplicadas</label>
                <select name="Ofertas" id="" class="form-select">
                    @php
                        $ofertas = DB::select('select * from ofertas')
                    @endphp

                    @foreach ($ofertas as $oferta)
                        <option value="{{$oferta->IdOferta}}">{{$oferta->Descripcion}}</option>
                    @endforeach

                </select>
            </div>
            <div class="mb-3">
                <label for="Disponibilidad" class="form-label" style="font-weight: bold">Disponibilidad</label>
                <select name="Disponibilidad" id="" class="form-select">
                    <option value="Disponible">Disponible</option>
                    <option value="No Disponible">No Disponible</option>
                </select>
            </div>
            <div class="mb-3">
                @if (isset($paquetes_turisticos))
                <input type="submit" value="Actualizar" class="btn btn-success">

                @else
                <input type="submit" value="Guardar" class="btn btn-success">

                @endif
                <br>
                <p class="font-weight-bold text-uppercase px-3 small mt-3 mb-0">Otras Acciones</p>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="#"  style="text-decoration: none; color: white;"> Asignar Imagenes</a></button>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="#"  style="text-decoration: none; color: white;"> Administrar Categorías</a></button>
                <button type="button" class="btn btn-primary mt-1" style="width: 14em;"> <a href="#"  style="text-decoration: none; color: white;"> Administrar Ofertas</a></button>
            </div>
        </form>
    </div>
 

       
   
</div>
</div>
<x-footeradmin></x-footeradmin>