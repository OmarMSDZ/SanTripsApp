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
        
        <?php
        $paquetes = DB::select("SELECT p.idPaquete as id, p.Nombre as nombre, p.Descripcion as descripcion,
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
    {{-- Aqui va el id de cada paquete, oculto --}}
             <p class="id" hidden>{{$paquete->id}}</p>
                    <img src="{{asset('img/logosantri.jpeg')}}" alt="" class="card-img-top">

                    
                    <h2 class="card-title">{{$paquete->nombre}} </h2>
                    <p class="card-text">{{$paquete->categoria}}</p>
                  
                    <button class="btn btn-primary" onclick="toggleMoreInfo(this)">Ver Más</button>
                    <div class="more-info d-none">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{$paquete->descripcion}}</li>
                            <li class="list-group-item">{{$paquete->numpersonas}}</li>
                            <li class="list-group-item">{{$paquete->edades}}</li>
                            <li class="list-group-item">{{$paquete->idiomas}}</li>
                            <li class="list-group-item">{{$paquete->alojamiento}}</li>
                            <li class="list-group-item">{{$paquete->tiempoestimado}}</li>
                            <li class="list-group-item">{{$paquete->disponibilidad}}</li>
                            <li class="list-group-item">{{$paquete->costo}}</li>
                        </ul>
                        <form action="{{ route('procesar_reserva')}}" method="POST">
                            @csrf <!-- Agrega el token CSRF para protección -->
                            <input type="text" name="id" value="{{$paquete->id}}">
                            <button type="submit" class="btn btn-primary mt-3">Reservar</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div> 

        @endforeach
    <!-- Aquí irían las otras tarjetas de los paquetes turísticos, siguiendo el mismo patrón -->
     </div>
 

 

     
</main>

<script>
    function toggleMoreInfo(button) {
        const moreInfo = button.nextElementSibling;
        moreInfo.classList.toggle('d-none');
        button.textContent = moreInfo.classList.contains('d-none') ? 'Ver Más' : 'Hide';
    }
</script>

<x-footerusuario></x-footerusuario>
