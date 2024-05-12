$( function () {

    const PARAMETROS = {
        URL_DATATABLE: route('destinos.getDestinos')
    }
    var dataTable = $('#table_id').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        "ajax" : `${PARAMETROS.URL_DATATABLE}?${$('#formBusqueda').serialize()}`,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        },
        "columns": [
            // {data: 'id'},
            {data: 'nombre'},
            {data: 'proveedor'},
            {data: 'provincia'},
            {data: 'hora_desde'},
            {data: 'hora_hasta'},
            {data: 'creado_por'},

            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


    //LIMPIA EL FORMULARIO
    const limpiarFormModal =()=> {
        $('#codigo_destino').val('0');
        $('.limpiarForm').val('');
        $('.selectLimpiarForm').val('');
        $('.selectLimpiarForm').val('');
    }

    $('#btnNuevoRegistro').click( function () {
        limpiarFormModal();
        $('#modalRegistroDestino').modal('show');
    });

    $('#btnGuardar').click( function () {
        $('#registroDestino').submit();
    });


    $("#registroDestino").validate({
        rules: {
            identificacion: "required",
        },
        messages: {

        },
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
            let url = route('destinos.store');
            let method = 'POST';

            const ID = $('#codigo_destino').val();

            if(ID != 0) {

                url = route('destinos.update', {id_destino: ID});
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
                  $("#btnGuardar").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...').prop("disabled", true);
              },
              success: function (response) {

                //OCULTAR EL MODAL DEL REGISTRO
                $('#modalRegistroDestino').modal('hide');

                //LIMPIAR EL FORMULARIO
                limpiarFormModal();
                $('#formBusqueda').submit();
                setTimeout(() => $("#btnGuardar").html("Guardar").prop("disabled", false), 1000);

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
                setTimeout(() => $("#btnGuardar").html("Guardar").prop("disabled", false), 1000);
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
                  setTimeout(() => $("#btnGuardar").html("Guardar").prop("disabled", false), 1000);
              },
          });
        },
    });

    $('#formBusqueda').submit(function (e) {
        e.preventDefault();
        dataTable.ajax.url(`${PARAMETROS.URL_DATATABLE}?${$('#formBusqueda').serialize()}`).load();
    });

    $('#table_id').on('click', '.btnActualizar', function () {

        const codigo = $(this).attr('codigo');

        const url = route('destinos.getDestino', {id_destino: codigo});

        $.get(url, function (response) {

            const $form = $('#registroDestino');

            $form.find('#codigo_destino').val(response.id);
            $form.find('#nombre_destino').val(response.nombre);
            $form.find('#empresa').val(response.id_proveedor);
            $form.find('#tipo_destino').val(response.id_tipo_destino);
            $form.find('#provincia').val(response.id_provincia);
            $form.find('#abierto_desde').val(response.hora_desde);
            $form.find('#abierto_hasta').val(response.hora_hasta);
            $form.find('#observaciones').val(response.observaciones);

            $('#modalRegistroDestino').modal('show');

            console.log('response: ', response);

        }, 'json');
        console.log('codigo: ', codigo);
    });

    $('#table_id').on('click', '.btnCambiarEstado', function () {

        const codigo = $(this).attr('codigo');
        const estado = $(this).attr('estado');

        Swal.fire({
            position: "top-center",
            icon: "question",
            title: 'Estas seguro que desean inactivar el Destino X',
            confirmButtonText: "Si, desactivar",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            // showConfirmButton: false,
            // timer: 1500,
        }).then((results) => {
            //   window.location.href = response.url;
            console.log('SI');
        });
        console.log('codigo: ', codigo);
    });


});
