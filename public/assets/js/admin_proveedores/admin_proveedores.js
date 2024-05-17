$( function () {

    const PARAMETROS = {
        URL_DATATABLE: route('proveedores.getProveedores')
    }
    var dataTable = $('#tablaProveedor').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        "ajax" : `${PARAMETROS.URL_DATATABLE}?${$('#formBusqueda').serialize()}`,
        "language": {
            // "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        },
        "columns": [
            // {data: 'id'},
            {data: 'nombre'},
            {data: 'telefono'},
            {data: 'email'},
            {data: 'nombretiposervicio'},
            // {data: 'pais'},
            {data: 'provincia'},
            {data: 'direccion'},
            
            {data: 'estado'},

            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


    //LIMPIA EL FORMULARIO
    const limpiarFormModal =()=> {
        $('#codigo_proveedor').val('0');
        $('.limpiarForm').val('');
        $('.selectLimpiarForm').val('');
        $('.selectLimpiarForm').val('');
    }

    $('#btnNuevoRegistro').click( function () {
        limpiarFormModal();
        $('#modalRegistroProveedor').modal('show');
    });

    $('#btnGuardar').click( function () {
        $('#registroProveedor').submit();
    });


    $("#registroProveedor").validate({
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
            let url = route('proveedores.store');
            let method = 'POST';

            const ID = $('#codigo_proveedor').val();

            if(ID != 0) {

                url = route('proveedores.update', {id_proveedor: ID});
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
                $('#modalRegistroProveedor').modal('hide');

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

    $('#tablaProveedor').on('click', '.btnActualizar', function () {

        const codigo = $(this).attr('codigo');

        const url = route('proveedores.getProveedor', {id_proveedor: codigo});

        $.get(url, function (response) {

            const $form = $('#registroProveedor');

            $form.find('#codigo_proveedor').val(response.id);
            $form.find('input[name="nombre"]').val(response.nombre);
            $form.find('input[name="telefono"]').val(response.telefono);
            $form.find('input[name="email"]').val(response.email);
            $form.find('#tiposervicio').val(response.tiposervicio);
            // $form.find('select[name="pais"]').val(response.id_pais);
            $form.find('select[name="provincia"]').val(response.provincia);
            $form.find('textarea[name="direccion"]').val(response.direccion);
            $form.find('select[name="estado"]').val(response.estado);
            

            $('#modalRegistroProveedor').modal('show');

            console.log('response: ', response);

        }, 'json');
        console.log('codigo: ', codigo);
    });

    $('#tablaProveedor').on('click', '.btnCambiarEstado', function () {

        const codigo = $(this).attr('codigo');
        const estado = $(this).attr('estado');
        const nombre = $(this).attr('nombre');

        const $form = $('#formCambiarProveedor');

        let msg = `Estas seguro que deseas activar el proveedor ${nombre}`;

        //RECOMENDACION CAMBIAR A BOOLEANO (1 O 0)
        if(estado == 'ACTIVO') {
             msg = `Estas seguro que deseas desactivar el proveedor ${nombre}`;
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
            $('#formCambiarProveedor').submit();
        });

        console.log('codigo: ', codigo);
    });
    

    $('#formCambiarProveedor').submit( function (e) {
        e.preventDefault();
        // const data = new FormData(this);

        console.log('enviando....');

        const $form = $('#formCambiarProveedor');

        const data = {
            codigo: $form.find('input[name="codigo"]').val(),
            estado: $form.find('input[name="estado"]').val(),
            _token: $form.find('input[name="_token"]').val(),
        };

        const url = route('proveedores.cambiar_estado', {id_proveedor: data.codigo});

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



});
