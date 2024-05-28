// const { createLogger } = require("vite");

$( function () {

    const PARAMETROS = {
        URL_DATATABLE: route('paquetes.getPaquetes'),
       //para poder borrar registros
        URL_DESTROY: (id) => route('paquetes.destroy', {id_paquete: id}),

        URL_UPDATEIMAGES: (id) => route('paquetes.deleteImagenes', {id_paquete: id})
        
    
    }
    var dataTable = $('#tablaPaquete').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        "ajax" : `${PARAMETROS.URL_DATATABLE}?${$('#formBusqueda').serialize()}`,
        "language": {
            // "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        },
        "columns": [
            // {data: 'id'},
            {data: 'nombre'},
            {data: 'descripcion'},
            {data: 'costo'},
            {data: 'numpersonas'},
            {data: 'edades'},
            {data: 'idiomas'},
            {data: 'alojamiento'},
            {data: 'tiempoestimado'},
            {data: 'disponibilidad'},
            {data: 'horainicio'},
            
            
            //campos fk 
            {data: 'categoriapaq'},
            {data: 'oferta'},


            {data: 'estado'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#formBusqueda').submit(function (e) {

        //EVITA QUE SE ACTUALICE LA PAGINA AL ENVIAR LA DATA DE BUSQUEDA
        e.preventDefault();
        dataTable.ajax.url(`${PARAMETROS.URL_DATATABLE}?${$('#formBusqueda').serialize()}`).load();
    });

    //LIMPIA EL FORMULARIO
    const limpiarFormModal =()=> {
        $('#codigo_paquete').val('0');
        $('.limpiarForm').val('');
        $('.selectLimpiarForm').val('');
        $('#estado').val('ACTIVO');
    }

    $('#btnNuevoRegistro').click( function () {
        limpiarFormModal();


        $('#btnProcesar').text('GUARDAR');
        $('#modalRegistroPaquete  .modal-title').text('Registro de Paquete Turístico');

        $('#modalRegistroPaquete').modal('show');
    });



    $('#btnProcesar').click( function () {

        $("#registroPaquete").submit();
    });


    $("#registroPaquete").validate({
   
        highlight: function (element, errorClass, validClass) {
            var elem = $(element);
            if (elem.hasClass("select2-hidden-accessible")) {
                $("#select2-" + elem.attr("id") + "-container").parent().addClass(errorClass);
            } else {
                elem.addClass(errorClass);
            }
        },
        unhighlight: function (element, errorClass, validClass) {
            var elem = $(element);
            if (elem.hasClass("select2-hidden-accessible")) {
                $("#select2-" + elem.attr("id") + "-container").parent().removeClass(errorClass);
            } else {
                elem.removeClass(errorClass);
            }
        },
        errorPlacement: function (error, element) {
            var elem = $(element);
            if (elem.hasClass("select2-hidden-accessible")) {
                element = $("#select2-" + elem.attr("id") + "-container").parent();
                error.insertAfter(element);
            } else {
                if (elem.parent().hasClass("input-group")) {
                    elem = elem.parent();
                    error.addClass("invalid-feedback");
                    error.insertAfter(elem);
                } else {
                    error.addClass("invalid-feedback");
                    error.insertAfter(element);
                }
            }
        },
        submitHandler: function (form) {

            const data_form = new FormData(form);
            let url = route('paquetes.store');
            let method = 'POST';

            const ID = $('#codigo_paquete').val();

            if(ID != 0) {

                url = route('paquetes.update', {id_paquete: ID});
            }

            $.ajax({
              type: "POST", //params.method,
              method: method,
              url: url,
              data: data_form,
            //   mimeType: "multipart/form-data",
              contentType: false,
              dataType: "json",
              cache: false,
              processData: false,
              beforeSend: function () {
                  $("#btnProcesar").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...').prop("disabled", true);
              },
              success: function (response) {

                $("#btnProcesar").html("Guardar").prop("disabled", false);
                //OCULTAR EL MODAL DEL REGISTRO
                $('#modalRegistroPaquete').modal('hide');

                //LIMPIAR EL FORMULARIO
                limpiarFormModal();
                $('#formBusqueda').submit();
                setTimeout(() => $("#btnProcesar").html("Guardar").prop("disabled", false), 1000);

                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500,
                }).then((results) => {
                    //   window.location.href = response.url;
                });
              },
              error: function (XMLHttpRequest, textStatus, errorThrown) {
                setTimeout(() => $("#btnProcesar").html("Guardar").prop("disabled", false), 1000);
                const data = XMLHttpRequest.responseJSON;
                  console.log(
                      "XMLHttpRequest: ",
                      XMLHttpRequest.responseJSON
                  );

                  Swal.fire({
                      icon: "warning",
                      title: "Alerta",
                      text: data.msg,
                  });
              },
              complete: function () {
                  setTimeout(() => $("#btnProcesar").html("Guardar").prop("disabled", false), 1000);
              },
          });
        },
    });

    //EVENTO ASOCIADO AL BOTON DE ACTUALIZAR DE LA TABLA
    $('#tablaPaquete').on('click', '.btnActualizar', function () {

        $('#btnProcesar').text('ACTUALIZAR');
        $('#modalRegistroPaquete  .modal-title').text('Actualizar registro de Paquete Turístico');

        //CODIGO IDENTIFICADOR DEL REGISTRO
        const codigo = $(this).attr('codigo');

        //RUTA DE CONSULTA DEL ID DE EMPLEADO
        const url = route('paquetes.getPaquete', {id_paquete: codigo});

        $.get(url, function (response) {


            const $form = $('#registroPaquete');
            //en el response van los nombres de los campos en la BD
            $form.find('#codigo_paquete').val(response.id);
            $form.find('input[name="nombre"]').val(response.nombre);
            $form.find('#descripcion').val(response.descripcion);
            $form.find('input[name="costo"]').val(response.costo);
            $form.find('input[name="numpersonas"]').val(response.numpersonas);
            $form.find('select[name="edades"]').val(response.edades);
            $form.find('select[name="idiomas"]').val(response.idiomas);
            $form.find('select[name="alojamiento"]').val(response.alojamiento);
 
            $form.find('input[name="tiempoestimado"]').val(response.tiempoestimado);
            $form.find('select[name="disponibilidad"]').val(response.disponibilidad);
            $form.find('input[name="horainicio"]').val(response.horainicio);
            


            //campos de fk 
            // $form.find('select[name="cargo"]').val(response.id_cargo);
            $form.find('select[name="categoriapaq"]').val(response.categoriapaq);
            $form.find('select[name="oferta"]').val(response.oferta);

            $form.find('#estado').val(response.estado);

            $('#modalRegistroPaquete').modal('show');

            console.log('response: ', response);

        }, 'json');
        console.log('codigo: ', codigo);
    });

    $('#tablaPaquete').on('click', '.btnCambiarEstado', function () {

        const codigo = $(this).attr('codigo');
        const estado = $(this).attr('estado');
        const nombre = $(this).attr('nombre');

        const $form = $('#formCambiarPaquete');

        let msg = `Estas seguro que deseas activar el paquete ${nombre}`;

        //RECOMENDACION CAMBIAR A BOOLEANO (1 O 0)
        if(estado == 'ACTIVO') {
             msg = `Estas seguro que deseas desactivar el paquete ${nombre}`;
        }

        $form.find('input[name="codigo"]').val(codigo);
        $form.find('input[name="estado"]').val(estado);

        Swal.fire({
            position: "top-center",
            icon: "question",
            title: msg,
            confirmButtonText: "Si, desactivar",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            // showConfirmButton: false,
            // timer: 1500,
        }).then((results) => {
            console.log('SI');
            $('#formCambiarPaquete').submit();
        });

        console.log('codigo: ', codigo);
    });
    

    $('#formCambiarPaquete').submit( function (e) {
        e.preventDefault();
        // const data = new FormData(this);

        console.log('enviando....');

        const $form = $('#formCambiarPaquete');

        const data = {
            codigo: $form.find('input[name="codigo"]').val(),
            estado: $form.find('input[name="estado"]').val(),
            _token: $form.find('input[name="_token"]').val(),
        };

        const url = route('paquetes.cambiar_estado', {id_paquete: data.codigo});

        $.post(url, data, function (response) {
            $('#formBusqueda').submit();

            //CAMBIAR A BOOLEANO
            const mensaje = (data.estado == "ACTIVO") ? 'Se ha inhabilitado de forma correcta!' : 'Se ha habilitado de forma correcta!';

            Swal.fire({
                position: "top-center",
                icon: "success",
                title: mensaje,
                showConfirmButton: false,
                timer: 1500,
            });
        });

    });

    
    //FUNCION PARA ELIMINAR REGISTROS


    $('#tablaPaquete').on('click', '.btnEliminar', function () {
        const codigo = $(this).attr('codigo');
        const url = PARAMETROS.URL_DESTROY(codigo);

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: {_token: $('meta[name="csrf-token"]').attr('content')},
                    success: function (response) {
                        if(response.code === 200) {
                            Swal.fire(
                                'Eliminado!',
                                response.message,
                                'success'
                            );
                            dataTable.ajax.reload();
                        } else {
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                                 console.log(xhr.responseText);
                             console.log(textStatus);
                                 console.log(errorThrown);

                                 Swal.fire(
                                    'Error!',
                                    'Hubo un problema al eliminar el registro.',
                                    'error'
                                );
                                
                        
                    }
                });
            }
        })
    }); 


    
    $('#tablaPaquete').on('click', '.btnDeleteImagenes', function () {
        const codigo = $(this).attr('codigo');
        const url = PARAMETROS.URL_UPDATEIMAGES(codigo);

        Swal.fire({
            title: '¿Estás seguro de limpiar las imagenes?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {_token: $('meta[name="csrf-token"]').attr('content')},
                    success: function (response) {
                        if(response.code === 200) {
                            Swal.fire(
                                'Eliminado!',
                                response.message,
                                'success'
                            );
                            dataTable.ajax.reload();
                        } else {
                            Swal.fire(
                                'Error!',
                                response.message,
                                'error'
                            );
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        Swal.fire(
                            'Error!',
                            'Hubo un problema al eliminar las imagenes',
                            'error'
                        );
                    }
                });
            }
        })
    });








});
