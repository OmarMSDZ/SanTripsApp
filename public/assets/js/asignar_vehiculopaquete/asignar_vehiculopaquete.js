$(function () {
    const PARAMETROS = {
        URL_DATATABLE: route('vehiculos_paquetes.getVehiculosPaquetes'),
        URL_DESTROY: (id) => route('vehiculos_paquetes.destroy', {IdVehiculosPaquetes: id})
    };

    var dataTable = $('#tablavehiculos_paquetes').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        ajax: `${PARAMETROS.URL_DATATABLE}?${$('#formBusqueda').serialize()}`,
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

        columns: [
            {data: 'IdVehiculosPaquetes'},
            {data: 'id_paquetes_turistico'},
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
    $('#codigo_vehiculo_paquete').val('0');
    $('.limpiarForm').val('');
    $('.selectLimpiarForm').val('');
    //$('#estado').val('ACTIVO');
};

$('#btnNuevoRegistro').click(function () {
    limpiarFormModal();
    $('#btnProcesar').text('GUARDAR');
    $('#modalRegistroVehiculos_paquetes .modal-title').text('Registro de vehiculo paquete');
    $('#modalRegistroVehiculos_paquetes').modal('show');
});


$('#btnProcesar').click(function () {
    $("#registroVehiculos_paquetes").submit();
});

$("#registroVehiculos_paquetes").validate({
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
        let url = route('vehiculos_paquetes.store');
        let method = 'POST';

        const ID = $('#codigo_vehiculo_paquete').val();

        if (ID != 0) {
            url = route('vehiculos_paquetes.update', {IdVehiculosPaquetes: ID});
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
                $('#modalRegistroVehiculos_paquetes').modal('hide');
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
$('#tablavehiculos_paquetes').on('click', '.btnActualizar', function () {

    $('#btnProcesar').text('ACTUALIZAR');
    $('#modalRegistroVehiculos_paquetes .modal-title').text('Actualizar registro de vehiculo paquete');

    // CÓDIGO IDENTIFICADOR DEL REGISTRO
    const codigo = $(this).attr('codigo');

    // RUTA DE CONSULTA DEL ID DEL CARGO
    const url = route('vehiculos_paquetes.getVehiculoPaquete', {IdVehiculosPaquetes: codigo});

    $.get(url, function (response) {

        const $form = $('#registroVehiculos_paquetes');

        $form.find('#codigo_vehiculo_paquete').val(response.IdVehiculosPaquetes);
        $form.find('input[name="cargo"]').val(response.cargo);
        $form.find('input[name="sueldo"]').val(response.sueldo);
        $form.find('textarea[name="responsabilidades"]').val(response.responsabilidades);
        //$form.find('select[name="estado"]').val(response.estado);

        $('#modalRegistroVehiculos_paquetes').modal('show');

        console.log('response: ', response);

    }, 'json').fail(function (jqXHR, textStatus, errorThrown) {
        // Código para manejar el error
        console.log(jqXHR.responseText);
    });
});


$('#tablavehiculos_paquetes').on('click', '.btnCambiarEstado', function () {

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

    //const url = route('admincargoempleado.cambiar_estado', {IdVehiculosPaquetes: data.codigo});

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

$('#tablavehiculos_paquetes').on('click', '.btnEliminar', function () {
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





