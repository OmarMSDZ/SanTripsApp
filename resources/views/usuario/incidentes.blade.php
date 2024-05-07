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
</style>
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
                                En caso de experimentar algun problema utilizando nuestros servicios, notifica al equipo
                                de SanTrips mediante esta vía. Resolveremos cada caso de la manera mas rapida y
                                eficiente
                                posible.
                            </p>
                        </div>

                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <div class="card">
                                <div class="card-body py-5 px-md-5">
                                    <form action="" method="POST">

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div data-mdb-input-init class="form-outline">
                                                    <label class="form-label" for="fechaincidente">Fecha</label>
                                                    <input type="date" name="fechaincidente" id=""
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div data-mdb-input-init class="form-outline">
                                                    <label class="form-label" for="tipoincidente">Tipo</label>
                                                    <select name="tipoincidente" id="" class="form-select">
                                                        <option value="1">Opcion 1</option>
                                                        <option value="2">Opcion 2</option>
                                                        <option value="3">Opcion 3</option>
                                                        <option value="4">Opcion 4</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="descripcionincidente">Descripción</label>
                                            <textarea name="descripcionincidente" id="" cols="30" rows="10" class="form-control"></textarea>

                                        </div>


                                        <!-- Submit button -->
                                        <center>
                                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-primary btn-block mb-4 ">
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
