$(function () {
    const PARAMETROS = {
        URL_DATATABLE: route('asignarvehiculoempleado.getAsignacionesVehiculos'),
        //URL_DESTROY: (id) => route('vehiculos_paquetes.destroy', {IdVehiculosPaquetes: id})
    };

    var dataTable = $('#tablaasignacion_vehiculo').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        // ajax: `${PARAMETROS.URL_DATATABLE}?${$('#formBusqueda').serialize()}`,
         //se hace de esta manera el ajax por si da un error saber localizarlo
         ajax: {
             url: PARAMETROS.URL_DATATABLE,
             type: 'GET',
             data: $('#formBusqueda').serialize(),
             success: function(data) {
                 dataTable.clear().draw();
                 dataTable.rows.add(data).draw();
             },
             error: function(xhr, textStatus, errorThrown) {
                 console.log(xhr.responseText);
                 console.log(textStatus);
                 console.log(errorThrown);
             }
         },
        "language": {
            // "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        },

        columns: [
            {data: 'IdAsignacion'},
            {data: 'FechaAsignacion'},
            {data: 'id_empleado'},
            {data: 'fk_IdVehiculo'},
            {data: 'estado'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});

$('#formBusqueda').submit(function (e) {
    e.preventDefault();
    dataTable.ajax.url(`${PARAMETROS.URL_DATATABLE}?${$('#formBusqueda').serialize()}`).load();
});

const limpiarFormModal = () => {
    $('#codigo_vehiculoEmpleado').val('0');
    $('.limpiarForm').val('');
    $('.selectLimpiarForm').val('');
    //$('#estado').val('ACTIVO');
};

$('#btnNuevoRegistro').click(function () {
    limpiarFormModal();
    $('#btnProcesar').text('GUARDAR');
    $('#modalRegistroVehiculoEmpleado .modal-title').text('Registro de vehiculo empleado');
    $('#modalRegistroVehiculoEmpleado').modal('show');
});


$('#btnProcesar').click(function () {
    $("#registroVehiculoEmpleado").submit();
});

$("#registroVehiculoEmpleado").validate({
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
        let url = route('asignarvehiculoempleado.store');
        let method = 'POST';

        const ID = $('#codigo_vehiculoEmpleado').val();

        if (ID != 0) {
            url = route('asignarvehiculoempleado.update', {IdAsignacion: ID});
        }

        $.ajax({
            type: "POST",
            method: method,
            url: url,
            data: data_form,
            contentType: false,
            dataType: "json",
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#btnProcesar").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...').prop("disabled", true);
            },
            success: function (response) {
                $("#btnProcesar").html("Guardar").prop("disabled", false);
                $('#modalRegistroVehiculoEmpleado').modal('hide');
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
                console.log("XMLHttpRequest: ", XMLHttpRequest.responseJSON);

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



// EVENTO ASOCIADO AL BOTÓN DE ACTUALIZAR DE LA TABLA
$('#tablaasignacion_vehiculo').on('click', '.btnActualizar', function () {

    $('#btnProcesar').text('ACTUALIZAR');
    $('#modalRegistroVehiculoEmpleado .modal-title').text('Actualizar registro de vehiculo paquete');

    // CÓDIGO IDENTIFICADOR DEL REGISTRO
    const codigo = $(this).attr('codigo');

    // RUTA DE CONSULTA DEL ID DEL CARGO
    const url = route('asignarvehiculoempleado.getAsignacionVehiculo', {IdAsignacion: codigo});

    $.get(url, function (response) {

        const $form = $('#registroVehiculoEmpleado');

        $form.find('#codigo_vehiculoEmpleado').val(response.IdAsignacion);
        $form.find('input[name="cargo"]').val(response.cargo);
        $form.find('input[name="sueldo"]').val(response.sueldo);
        $form.find('textarea[name="responsabilidades"]').val(response.responsabilidades);
        //$form.find('select[name="estado"]').val(response.estado);

        $('#modalRegistroVehiculoEmpleado').modal('show');

        console.log('response: ', response);

    }, 'json').fail(function (jqXHR, textStatus, errorThrown) {
        // Código para manejar el error
        console.log(jqXHR.responseText);
    });
});


$('#tablaasignacion_vehiculo').on('click', '.btnCambiarEstado', function () {

    const codigo = $(this).attr('codigo');
   // const estado = $(this).attr('estado');
    const nombre = $(this).attr('nombre');

    const $form = $('#formcambiarEstadoVehiculoPaquete');

    let msg = `¿Estás seguro de que deseas activar el cargo de empleado ${nombre}?`;

    // RECOMENDACIÓN: CAMBIAR A BOOLEANO (1 O 0)
    // if (estado == 'ACTIVO') {
    //     msg = `¿Estás seguro de que deseas desactivar el cargo de empleado ${nombre}?`;
    // }

    // $form.find('input[name="codigo"]').val(codigo);
    // $form.find('input[name="estado"]').val(estado);

    // Swal.fire({
    //     position: "top-center",
    //     icon: "question",
    //     title: msg,
    //     showCancelButton: true,
    //     confirmButtonText: "Sí",
    //     cancelButtonText: "Cancelar",
    // }).then((result) => {
    //     if (result.isConfirmed) {
    //         $('#formCambiarCargo').submit();
    //     }
    // });

    console.log('codigo: ', codigo);
});

$('#formcambiarEstadoVehiculoPaquete').submit(function (e) {
    e.preventDefault();

    const $form = $('#formcambiarEstadoVehiculoPaquete');

    const data = {
        codigo: $form.find('input[name="codigo"]').val(),
        //estado: $form.find('input[name="estado"]').val(),
        _token: $form.find('input[name="_token"]').val(),
    };

    //const url = route('admincargoempleado.cambiar_estado', {IdAsignacion: data.codigo});

    $.post(url, data, function (response) {
        $('#formBusqueda').submit();

        // CAMBIAR A BOOLEANO
       // const mensaje = (data.estado == "ACTIVO") ? 'Se ha desactivado de forma correcta' : 'Se ha activado de forma correcta';

        Swal.fire({
            position: "top-center",
            icon: "success",
            title: mensaje,
            showConfirmButton: false,
            timer: 1500,
        });
    });
});



// FUNCIÓN PARA ELIMINAR REGISTROS

$('#tablaasignacion_vehiculo').on('click', '.btnEliminar', function () {
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
                    if (response.code === 200) {
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
    });
});





