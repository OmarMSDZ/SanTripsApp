// const { createLogger } = require("vite");

$( function () {

    const PARAMETROS = {
        URL_DATATABLE: route('vehiculos.getVehiculos'),

         //para poder borrar registros
         URL_DESTROY: (id) => route('vehiculos.destroy', {id_vehiculo: id})

    }
    var dataTable = $('#tablaVehiculo').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        "ajax" : `${PARAMETROS.URL_DATATABLE}?${$('#formBusqueda').serialize()}`,
        //se hace de esta manera el ajax por si da un error saber localizarlo
        // ajax: {
        //     url: PARAMETROS.URL_DATATABLE,
        //     type: 'GET',
        //     data: $('#formBusqueda').serialize(),
        //     success: function(data) {
        //         dataTable.clear().draw();
        //         dataTable.rows.add(data).draw();
        //     },
        //     error: function(xhr, textStatus, errorThrown) {
        //         console.log(xhr.responseText);
        //         console.log(textStatus);
        //         console.log(errorThrown);
        //     }
        // },
        "language": {
            // "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        },
        "columns": [
            // {data: 'id'},
            {data: 'descripcion'},
            {data: 'matricula'},
            {data: 'fechaingreso'},
            {data: 'cantidadpasajeros'},
            {data: 'anovehiculo'},
            {data: 'color'},
            {data: 'tipocombustible'},
            {data: 'tipovehiculo'},
            {data: 'marcavehiculo'},
            {data: 'modelovehiculo'},
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
        $('#codigo_vehiculo').val('0');
        $('.limpiarForm').val('');
        $('.selectLimpiarForm').val('');
        $('#estado').val('ACTIVO');
    }

    $('#btnNuevoRegistro').click( function () {
        limpiarFormModal();


        $('#btnProcesar').text('GUARDAR');
        $('#modalRegistroVehiculo  .modal-title').text('Registro de Vehículo');

        $('#modalRegistroVehiculo').modal('show');
    });



    $('#btnProcesar').click( function () {

        $("#registroVehiculo").submit();
    });


    $("#registroVehiculo").validate({
        // rules: {
        //     identificacion: "required",
        // },
        // messages: {

        // },
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
            let url = route('vehiculos.store');
            let method = 'POST';

            const ID = $('#codigo_vehiculo').val();

            if(ID != 0) {

                url = route('vehiculos.update', {id_vehiculo: ID});
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
                $('#modalRegistroVehiculo').modal('hide');

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
    $('#tablaVehiculo').on('click', '.btnActualizar', function () {

        $('#btnProcesar').text('ACTUALIZAR');
        $('#modalRegistroVehiculo  .modal-title').text('Actualizar registro de Vehiculo');

        //CODIGO IDENTIFICADOR DEL REGISTRO
        const codigo = $(this).attr('codigo');

        //RUTA DE CONSULTA DEL ID DE  
        const url = route('vehiculos.getVehiculo', {id_vehiculo: codigo});

        $.get(url, function (response) {

            const $form = $('#registroVehiculo');

            $form.find('#codigo_vehiculo').val(response.IdVehiculo);
            $form.find('input[name="descripcion"]').val(response.descripcion);
            $form.find('input[name="matricula"]').val(response.matricula);
            $form.find('input[name="fechaingreso"]').val(response.fechaingreso);
            $form.find('input[name="cantidadpasajeros"]').val(response.cantidadpasajeros);
            $form.find('input[name="anovehiculo"]').val(response.anovehiculo);
            $form.find('select[name="color"]').val(response.color);           
            $form.find('select[name="tipocombustible"]').val(response.tipocombustible);
            $form.find('select[name="tipovehiculo"]').val(response.idtipovehiculo);
            $form.find('select[name="marcavehiculo"]').val(response.idmarcavehiculo);
            $form.find('select[name="modelovehiculo"]').val(response.idmodelovehiculo);
            $form.find('#estado').val(response.estado);
 
            $('#modalRegistroVehiculo').modal('show');

            console.log('response: ', response);

        }, 'json').fail(function (jqXHR, textStatus, errorThrown) {
            // código para manejar el error
            console.log(jqXHR.responseText);
        // console.log('codigo: ', codigo);
            });
        
    });

    $('#tablaVehiculo').on('click', '.btnCambiarEstado', function () {

        const codigo = $(this).attr('codigo');
        const estado = $(this).attr('estado');
        const nombre = $(this).attr('nombre');

        const $form = $('#formCambiarVehiculo');

        let msg = `Estas seguro que deseas activar el Vehiculo ${nombre}`;

        //RECOMENDACION CAMBIAR A BOOLEANO (1 O 0)
        if(estado == 'ACTIVO') {
             msg = `Estas seguro que deseas desactivar el Vehiculo ${nombre}`;
        }

        $form.find('input[name="codigo"]').val(codigo);
        $form.find('input[name="estado"]').val(estado);

        Swal.fire({
            position: "top-center",
            icon: "question",
            title: msg,
            confirmButtonText: "Si",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            // showConfirmButton: false,
            // timer: 1500,
        }).then((results) => {
            console.log('SI');
            $('#formCambiarVehiculo').submit();
        });

        console.log('codigo: ', codigo);
    });
    

    $('#formCambiarVehiculo').submit( function (e) {
        e.preventDefault();
        // const data = new FormData(this);

        console.log('enviando....');

        const $form = $('#formCambiarVehiculo');

        const data = {
            codigo: $form.find('input[name="codigo"]').val(),
            estado: $form.find('input[name="estado"]').val(),
            _token: $form.find('input[name="_token"]').val(),
        };

        const url = route('vehiculos.cambiar_estado', {id_vehiculo: data.codigo});

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


    $('#tablaVehiculo').on('click', '.btnEliminar', function () {
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
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
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




});
