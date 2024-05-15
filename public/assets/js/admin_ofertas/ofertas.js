$( function () {

    const PARAMETROS = {
        URL_DATATABLE: route('ofertas.getOfertas')
    }
    var dataTable = $('#tablaOferta').DataTable({
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
        $('#codigo_oferta').val('0');
        $('.limpiarForm').val('');
        $('.selectLimpiarForm').val('');
        $('#estado').val('ACTIVO');
    }

    $('#btnNuevoRegistro').click( function () {
        limpiarFormModal();


        $('#btnProcesar').text('GUARDAR');
        $('#modalRegistroOferta  .modal-title').text('Registro de Oferta');

        $('#modalRegistroOferta').modal('show');
    });



    $('#btnProcesar').click( function () {

        $("#registroOferta").submit();
    });


    $("#registroOferta").validate({
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
                  $("#btnProcesar").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...').prop("disabled", true);
              },
              success: function (response) {

                $("#btnProcesar").html("Guardar").prop("disabled", false);
                //OCULTAR EL MODAL DEL REGISTRO
                $('#modalRegistroOferta').modal('hide');

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
    $('#tablaOferta').on('click', '.btnActualizar', function () {

        $('#btnProcesar').text('ACTUALIZAR');
        $('#modalRegistroOferta  .modal-title').text('Actualizar registro de Oferta');

        //CODIGO IDENTIFICADOR DEL REGISTRO
        const codigo = $(this).attr('codigo');

        //RUTA DE CONSULTA DEL ID DE EMPLEADO
        const url = route('ofertas.getOferta', {id_oferta: codigo});

        $.get(url, function (response) {

            const $form = $('#registroOferta');

            $form.find('#codigo_oferta').val(response.IdOferta);
            $form.find('input[name="descripcion_oferta"]').val(response.cedula);
            $form.find('input[name="porcentaje_oferta"]').val(response.nombre);
            $form.find('input[name="fecha_desde"]').val(response.apellido);
            $form.find('input[name="fecha_hasta"]').val(response.telefono);
          
            $form.find('#estado').val(response.estado);

            $('#modalRegistroOferta').modal('show');

            console.log('response: ', response);

        }, 'json');
        console.log('codigo: ', codigo);
    });
});
