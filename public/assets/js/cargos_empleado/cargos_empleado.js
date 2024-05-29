$(function () {
    const PARAMETROS = {
        URL_DATATABLE: route('admincargoempleado.getCargoempleados'),
        URL_DESTROY: (id) => route('admincargoempleado.destroy', {Idcargo: id})
    };

    var dataTable = $('#tablacargos_empleado').DataTable({
        responsive: true,
        dom: 'Bfrtip',
         ajax: `${PARAMETROS.URL_DATATABLE}?${$('#formBusqueda').serialize()}`,
         //se hace de esta manera el ajax por si da un error saber localizarlo
        //  ajax: {
        //      url: PARAMETROS.URL_DATATABLE,
        //      type: 'GET',
        //      data: $('#formBusqueda').serialize(),
        //      success: function(data) {
        //          dataTable.clear().draw();
        //          dataTable.rows.add(data).draw();
        //      },
        //      error: function(xhr, textStatus, errorThrown) {
        //          console.log(xhr.responseText);
        //          console.log(textStatus);
        //          console.log(errorThrown);
        //      }
        //  },
        "language": {
            // "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        },

        columns: [
            // {data: 'Idcargo'},
            {data: 'cargo'},
            {data: 'sueldo'},
            {data: 'responsabilidades'},
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
    $('#codigo_cargo').val('0');
    $('.limpiarForm').val('');
    $('.selectLimpiarForm').val('');
    //$('#estado').val('ACTIVO');
};

$('#btnNuevoRegistro').click(function () {
    limpiarFormModal();
    $('#btnProcesar').text('GUARDAR');
    $('#modalRegistroCargo .modal-title').text('Registro de Cargo');
    $('#modalRegistroCargo').modal('show');
});


$('#btnProcesar').click(function () {
    $("#registroCargo").submit();
});

$("#registroCargo").validate({
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
        let url = route('admincargoempleado.store');
        let method = 'POST';

        const ID = $('#codigo_cargo').val();

        if (ID != 0) {
            url = route('admincargoempleado.update', {idCargo: ID});
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
                $('#modalRegistroCargo').modal('hide');
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
$('#tablacargos_empleado').on('click', '.btnActualizar', function () {

    $('#btnProcesar').text('ACTUALIZAR');
    $('#modalRegistroCargo .modal-title').text('Actualizar registro de Cargo');

    // CÓDIGO IDENTIFICADOR DEL REGISTRO
    const codigo = $(this).attr('codigo');

    // RUTA DE CONSULTA DEL ID DEL CARGO
    const url = route('admincargoempleado.getCargoempleado', {Idcargo: codigo});

    $.get(url, function (response) {

        const $form = $('#registroCargo');

        $form.find('#codigo_cargo').val(response.Idcargo);
        $form.find('input[name="cargo"]').val(response.cargo);
        $form.find('input[name="sueldo"]').val(response.sueldo);
        $form.find('textarea[name="responsabilidades"]').val(response.responsabilidades);
        //$form.find('select[name="estado"]').val(response.estado);

        $('#modalRegistroCargo').modal('show');

        console.log('response: ', response);

    }, 'json').fail(function (jqXHR, textStatus, errorThrown) {
        // Código para manejar el error
        console.log(jqXHR.responseText);
    });
});


$('#tablacargos_empleado').on('click', '.btnCambiarEstado', function () {

    const codigo = $(this).attr('codigo');
   // const estado = $(this).attr('estado');
    const nombre = $(this).attr('nombre');

    const $form = $('#formCambiarCargo');

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

$('#formCambiarCargo').submit(function (e) {
    e.preventDefault();

    const $form = $('#formCambiarCargo');

    const data = {
        codigo: $form.find('input[name="codigo"]').val(),
        //estado: $form.find('input[name="estado"]').val(),
        _token: $form.find('input[name="_token"]').val(),
    };

    //const url = route('admincargoempleado.cambiar_estado', {idCargo: data.codigo});

    $.post(url, data, function (response) {
        $('#formBusqueda').submit();

        // CAMBIAR A BOOLEANO
        const mensaje = (data.estado == "ACTIVO") ? 'Se ha desactivado de forma correcta' : 'Se ha activado de forma correcta';

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


$('#tablacargos_empleado').on('click', '.btnBorrarRegistro', function () {

    const codigo = $(this).attr('codigo');

    console.log('codigo: ', codigo);

    Swal.fire({
        position: "top-center",
        icon: "question",
        title: 'Estas seguro que desean borrar este registro',
        confirmButtonText: "Si, borrar",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        // showConfirmButton: false,
        // timer: 1500,
    }).then((results) => {

        $.ajax({
            url: route('admincargoempleado.delete', {id: codigo}),
            type: 'DELETE',
            success: function(result) {
                // alert(result.message);
            
                //CONSULTA LOS RECORDS
                $('#formBusqueda').submit();
                // console.log('result: ', result);
                Swal.fire({
                    title: "Notificación!",
                    text: result.msg,
                    icon: "success"
                  });
            },
            error: function(xhr) {
                // alert(xhr.responseJSON.message);
            }
        });
    });

});


    





