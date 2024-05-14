$( function () {

    const PARAMETROS = {
        URL_DATATABLE: route('ofertas.getOfertas')
    }
    var dataTable = $('#table_id').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        "ajax" : `${PARAMETROS.URL_DATATABLE}?${$('#formBusqueda').serialize()}`,
        "language": {
            // "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        },
        "columns": [
            // {data: 'id'},
            {data: 'descripcion'},
            {data: 'porcentaje'},
            {data: 'fechadesde'},
            {data: 'fechahasta'}, 
            {data: 'creado_en'},
            {data: 'activo'},

            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


    //LIMPIA EL FORMULARIO
    const limpiarFormModal =()=> {
        $('#codigo_oferta').val('0');
        $('.limpiarForm').val('');
        $('.selectLimpiarForm').val('');
        $('.selectLimpiarForm').val('');
    }

    $('#btnNuevoRegistro').click( function () {
        limpiarFormModal();
        $('#modalRegistroOferta').modal('show');
    });

    $('#btnGuardar').click( function () {
        $('#registroOferta').submit();
    });


    $("#registroOferta").validate({
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
            let url = route('ofertas.store');
            let method = 'POST';

            const ID = $('#codigo_oferta').val();

            if(ID != 0) {

                url = route('ofertas.update', {id_oferta: ID});
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
                $('#modalRegistroOferta').modal('hide');

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

        const url = route('ofertas.getOferta', {id_oferta: codigo});

        $.get(url, function (response) {

            const $form = $('#registroOferta');

            $form.find('#codigo_oferta').val(response.id);
            $form.find('#descripcion_oferta').val(response.descripcion);
            $form.find('#porcentaje_oferta').val(response.porcentaje);
            $form.find('#fecha_desde').val(response.fechadesde);
            $form.find('#fecha_hasta').val(response.fechahasta);
           
            $('#modalRegistroOferta').modal('show');

            console.log('response: ', response);

        }, 'json');
        console.log('codigo: ', codigo);
    });

    $('#table_id').on('click', '.btnCambiarEstado', function () {

        const codigo = $(this).attr('codigo');
        const estado = $(this).attr('estado');

        const $form = $('#formCambiarOferta');
        $form.find('input[name="codigo"]').val(codigo);
        $form.find('input[name="estado"]').val(estado);



        Swal.fire({
            position: "top-center",
            icon: "question",
            title: 'Estas seguro que desea inactivar la oferta X',
            confirmButtonText: "Si, desactivar",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            // showConfirmButton: false,
            // timer: 1500,
        }).then((results) => {
            console.log('SI');
            $('#formCambiarOferta').submit();

        });
    });


    $('#formCambiarOferta').submit( function (e) {
        e.preventDefault();
        // const data = new FormData(this);

        console.log('enviando....');

        const $form = $('#formCambiarOferta');

        const data = {
            codigo: $form.find('input[name="codigo"]').val(),
            estado: $form.find('input[name="estado"]').val(),
            _token: $form.find('input[name="_token"]').val(),
        };

        const url = route('ofertas.cambiar_estado', {id_oferta: data.codigo});

        $.post(url, data, function (response) {
            $('#formBusqueda').submit();

            const mensaje = (data.estado == 1) ? 'Se ha inabilitado de forma correcta!' : 'Se ha habilitado de forma correcta!';

            Swal.fire({
                position: "top-center",
                icon: "success",
                title: mensaje,
                showConfirmButton: false,
                timer: 1500,
            });
        });

    });



});
