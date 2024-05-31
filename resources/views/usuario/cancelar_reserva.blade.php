<x-headusuario></x-headusuario>

<!-- DATOS PERSONALES -->
<!-- Section: Design Block -->
<section class="mt-5">
    <!-- Jumbotron -->
 

    <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
        <div class="container">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="my-5 display-3 fw-bold ls-tight">
                        Cancelar Reservación <br />
                        {{-- <span class="text-primary">for your business</span> --}}
                    </h2>
                     

                        <p style="color: hsl(217, 10%, 50.8%)">En SanTrips, Valoramos tu decision de cancelar una reservación, sin embargo, 
                        necesitamos confirmar los motivos por los que se desea cancelar la misma y que esté de acuerdo con nuestros terminos y condiciones.
                    </p>
                         
                        {{-- Aqui se muestran los destinos de este paquete --}}
                  

                </div>
                {{-- aqui iria el form de registro --}}
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card">
                        <div class="card-body py-5 px-md-5">
                            <form action="{{ route('cancelarReservacion') }}" method="POST">
                                @csrf
                                <center><img src="{{ asset('img/SanTrips (logo azul).svg') }}" alt=""
                                        class="form-img" style="width:6em;heigth:6em;"></center>
                                <center>
                                    <h2>Completa la siguiente información</h2>
                                </center>
                                <hr>
{{-- 
                                <input type="text" name="paquete_id" id="" value="{{ $paquete->idpaq }}"
                                    hidden> --}}
                                <input type="text" name="usuario_id" id="" value="{{ Auth::user()->id }}"
                                    hidden>


                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                         
                                            <label class="form-label" for="motivocancelacion">Motivo de la cancelación (Max 250 letras)</label>
                                            <textarea name="motivocancelacion" id="" cols="30" rows="6" class="form-control" minlength="10" maxlength="250"></textarea>

                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="CantidadPersonasAdultos">¿Aceptas lo Siguiente?</label>
                                            <hr class="mt-0">
                                          
                                            <div class="form-check form-check-inline">
                                                <label for="">Acepta que el reembolso de la cantidad pagada se hará dentro de 2 o 3 dias?</label>
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    id="SI"
                                                    value="ACEPTADO"
                                                    name="reembolsoSi"
                                                    required
                                                />
                                                <label class="form-check-label" for="reembolsoSi">Si, Acepto</label>
                                            </div>
                                           {{-- <div class="form-check form-check-inline">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    id=""
                                                    value="NEGADO"
                                                    name="reembolsoNo"
                                                />
                                                <label class="form-check-label" for="reembolsoNo">No estoy de acuerdo</label>
                                            </div>--}}
                                             

                                            {{-- Mostrar los inputs segun el valor de edades --}}

                                            {{-- para sumar los valores de los input --}}


                                        </div>
                                    </div>
                                </div>

                                <hr>

                             
                                <!-- para el boton del submit -->
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                    const correctCheckbox = document.getElementById('SI');
                                    const button = document.getElementById('cancelarReserva');

                                    correctCheckbox.addEventListener('change', function () {
                                        if (correctCheckbox.checked) {
                                            button.style.display = 'block';
                                        } else {
                                            button.style.display = 'none';
                                        }
                                    });
                                });
                                </script>
                                <center>
                                    {{-- id de la reserva que llamamos desde el controlador --}}
                                    <input type="text" name="id_reserva" value="{{$idReserva}}" hidden readonly>
                                    <input type="date" name="fecha_reserva" value="{{$fecha_reserva}}" hidden readonly>
                                    
                                    <button type="submit" id="cancelarReserva" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-block mb-4">Cancelar Reserva</button>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->
 

 

<x-footerusuario></x-footerusuario>
