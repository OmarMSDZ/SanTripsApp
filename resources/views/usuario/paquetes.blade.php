<x-headusuario></x-headusuario>
 

<style>
    .contenido {
        margin-top: 10em;
        margin-bottom: 10em;
    }

    .user-profile img {
        width: 124px;
        height: 124px;
    }

    .card-body img {
        size: auto;
    }
</style>

<main class="container contenido">
     <center> <h1>Paquetes Turísticos</h1> </center>
    <hr>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        {{-- Consulta para obtener la info de los paquetes --}}
        <?php
        $paquetes = DB::select("SELECT p.id as idpaq, p.Nombre as nombre, p.Descripcion as descripcion,
        p.Costo as costo, p.Num_personas as numpersonas, p.Edades as edades, p.Idiomas as idiomas, p.Alojamiento as alojamiento, p.Tiempo_estimado as tiempoestimado, 
        p.Disponibilidad as disponibilidad, c.CategoriaPaq as categoria, o.Porcentaje as porciento FROM
        paquetes_turisticos as p INNER JOIN categorias_paquetes as c ON p.fk_IdCategoriaPaq=c.IdCategoriaPaq INNER JOIN ofertas as o ON p.fk_IdOferta=o.IdOferta");
        ?>
        {{-- De esta forma se imprime cada paquete en la pagina luego de hacer la consulta --}}
        @foreach($paquetes as $paquete)
            {{-- <li>{{ $paquete->nombre }}</li> --}}
            
        <div class="col">
            <div class="card h-100">
                <div class="card-body"> 
 
                    <img src="{{asset('img/logosantri.jpeg')}}" alt="" class="card-img-top">

                    
                    <h2 class="card-title">{{$paquete->nombre}}</h2>
                    <p class="card-text"> <span style="font-weight:bold">Categoría:</span> {{$paquete->categoria}}</p>
                  
                    <button class="btn btn-primary" onclick="toggleMoreInfo(this)">Mostrar Más Información</button>
                    <div class="more-info d-none">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Descripción: {{$paquete->descripcion}}</li>
                            <li class="list-group-item">N° Max. Personas: {{$paquete->numpersonas}}</li>
                            <li class="list-group-item">Edades: {{$paquete->edades}}</li>
                            <li class="list-group-item">Idiomas: {{$paquete->idiomas}}</li>
                            <li class="list-group-item">Disponibilidad Alojamiento: {{$paquete->alojamiento}}</li>
                            <li class="list-group-item">Duración Estimada (En Horas): {{$paquete->tiempoestimado}}</li>
                            <li class="list-group-item">Disponibilidad: {{$paquete->disponibilidad}}</li>
                            <li class="list-group-item">Costo por persona (RD$): {{$paquete->costo}}</li>
                        </ul>
                        <form action="{{ route('procesar_reserva')}}" method="POST">
                            @csrf <!-- Agrega el token CSRF para protección -->
                            {{-- En esta parte se pasa el id del paquete a la otra vista --}}
                            <input type="text" name="id" value="{{$paquete->idpaq}}" hidden>
                            <button type="submit" class="btn btn-primary mt-3">Reservar</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div> 

        @endforeach
    <!-- Aquí irían las otras tarjetas de los paquetes turísticos, siguiendo el mismo patrón, se generarían automaticamente desde la BD -->
     </div>
 

 

     
</main>

<script>
    //para el boton de mostrar mas informacion 
    function toggleMoreInfo(button) {
        const moreInfo = button.nextElementSibling;
        moreInfo.classList.toggle('d-none');
        button.textContent = moreInfo.classList.contains('d-none') ? 'Mostrar Más Información' : 'Ocultar';
    }
</script>

<x-footerusuario></x-footerusuario>
