$( function () {

    const PARAMETROS = {
        URL_DATATABLE: route('empleados.getEmpleados')
    }
    var dataTable = $('#tablaEmpleado').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        "ajax" : `${PARAMETROS.URL_DATATABLE}?${$('#formBusqueda').serialize()}`,
        "language": {
            // "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        },
        "columns": [
            // {data: 'id'},
            {data: 'cedula'},
            {data: 'nombre'},
            {data: 'apellido'},
            {data: 'telefono'},
            {data: 'email'},
            {data: 'licencia_conducir'},
            {data: 'fecha_ingreso'},
            {data: 'fecha_salida'},
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
        $('#codigo_empleado').val('0');
        $('.limpiarForm').val('');
        $('.selectLimpiarForm').val('');
        $('#estado').val('ACTIVO');
    }

    $('#btnNuevoRegistro').click( function () {
        limpiarFormModal();


        $('#btnProcesar').text('GUARDAR');
        $('#modalRegistroEmpleado  .modal-title').text('Registro de empleado');

        $('#modalRegistroEmpleado').modal('show');
    });



    $('#btnProcesar').click( function () {

        $("#registroEmpleado").submit();
    });


    $("#registroEmpleado").validate({
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
            let url = route('empleados.store');
            let method = 'POST';

            const ID = $('#codigo_empleado').val();

            if(ID != 0) {

                url = route('empleados.update', {id_empleado: ID});
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
                $('#modalRegistroEmpleado').modal('hide');

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
    $('#tablaEmpleado').on('click', '.btnActualizar', function () {

        $('#btnProcesar').text('ACTUALIZAR');
        $('#modalRegistroEmpleado  .modal-title').text('Actualizar registro de empleado');

        //CODIGO IDENTIFICADOR DEL REGISTRO
        const codigo = $(this).attr('codigo');

        //RUTA DE CONSULTA DEL ID DE EMPLEADO
        const url = route('empleados.getEmpleado', {id_empleado: codigo});

        $.get(url, function (response) {

            const $form = $('#registroEmpleado');

            $form.find('#codigo_empleado').val(response.id);
            $form.find('input[name="cedula"]').val(response.cedula);
            $form.find('input[name="nombres"]').val(response.nombre);
            $form.find('input[name="apellidos"]').val(response.apellido);
            $form.find('input[name="telefono"]').val(response.telefono);
            $form.find('input[name="email"]').val(response.email);
            $form.find('input[name="licencia"]').val(response.licencia_conducir);
            $form.find('input[name="fechaingreso"]').val(response.fecha_ingreso);
            $form.find('input[name="fechasalida"]').val(response.fecha_salida);
            $form.find('#estado').val(response.estado);

            $('#modalRegistroEmpleado').modal('show');

            console.log('response: ', response);

        }, 'json');
        console.log('codigo: ', codigo);
    });
});
