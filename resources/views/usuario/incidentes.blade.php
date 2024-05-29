<x-headusuario></x-headusuario>
<br>
<style>
    .page {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .left {
        padding-right: 20px;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
        padding-top: 60px;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<!-- Modal HTML -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p>Tu mensaje ha sido enviado. ¡Lo tomaremos en cuenta!</p>
    </div>
</div>

<!----------------------------- Form box ----------------------------------->
<main class="mt-5">
    <article>
        <!-- Section: Design Block -->
        <section class="">
            <!-- Jumbotron -->
            <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
                <div class="container">
                    <div class="row gx-lg-5 align-items-center">
                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <h1 class="my-5 display-3 fw-bold ls-tight">
                                Incidentes <br />
                                {{-- <span class="text-primary">for your business</span> --}}
                            </h1>
                            <p style="color: hsl(217, 10%, 50.8%)">
                                En caso de experimentar algún problema utilizando nuestros servicios, notifica al equipo
                                de SanTrips mediante esta vía. Resolveremos cada caso de la manera más rápida y
                                eficiente posible.
                            </p>
                        </div>

                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <div class="card">
                                <div class="card-body py-5 px-md-5">
                                    <form action="{{ route('UserIncidente.store') }}" method="POST" onsubmit="showConfirmationModal(event)">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div data-mdb-input-init class="form-outline">
                                                    <label class="form-label" for="fechaincidente">Fecha</label>
                                                    <input type="date" name="fechaincidente" id="fechaincidente" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-6 col-sm-12 col-lg-6">
                                                <div class="mb-3">
                                                    <label for="Tipo incidente" class="form-label">Tipo de incidente</label>
                                                    <select name="tipoincidente" id="tipoincidente" class="form-control" required>
                                                        <option value="">Selecciona</option>
                                                        @foreach ($TiposIncidentes as $key)
                                                            <option value="{{ $key->id }}">{{ $key->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="descripcionincidente">Descripción</label>
                                            <textarea name="descripcionincidente" id="descripcionincidente" cols="30" rows="10" class="form-control"></textarea>
                                        </div>

                                        <!-- Submit button -->
                                        <center>
                                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                                                Enviar
                                            </button>
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
    </article>
</main>

<x-footerusuario></x-footerusuario>

<!-- JavaScript para controlar el modal -->
<script>
    function showConfirmationModal(event) {
        event.preventDefault(); // Evita que el formulario se envíe inmediatamente
        document.getElementById("confirmationModal").style.display = "block";

        setTimeout(function() {
            event.target.submit(); // Envía el formulario después de mostrar el mensaje
        }, 2000); // Ajusta el tiempo según tus necesidades
    }

    function closeModal() {
        document.getElementById("confirmationModal").style.display = "none";
    }
</script>
