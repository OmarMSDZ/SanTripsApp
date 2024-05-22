$(function () {

    //ENVIA EL TOKEN csrf A LA CABECERA DE FORMA AUTOMATICA
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const PARAMETROS = {
        URL_DATATABLE: route('paqdestino.getPaquetesdestinos')
    }
    var dataTable = $('#tablapaquetes_destinos').DataTable({
        responsive: true,
        dom: 'Bfrtip',
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
        "ajax": `${PARAMETROS.URL_DATATABLE}?${$('#formBusqueda').serialize()}`,
        "language": {
            // "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        },
        "columns": [

            // {title:'#', data: 'id'},
            { title: 'Nombre Paquete turistico', data: 'paquete_turistico' },
            { title: 'Destino', data: 'destino' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    $('#formBusqueda').submit(function (e) {

        //EVITA QUE SE ACTUALICE LA PAGINA AL ENVIAR LA DATA DE BUSQUEDA
        e.preventDefault();
        dataTable.ajax.url(`${PARAMETROS.URL_DATATABLE}?${$('#formBusqueda').serialize()}`).load();
    });

    //LIMPIA EL FORMULARIO
    const limpiarFormModal = () => {
        $('#codigo_paqdestino').val('0');
        $('.limpiarForm').val('');
        $('.selectLimpiarForm').val('');
        $('#estado').val('ACTIVO');
    }

    $('#btnNuevoRegistro').click(function () {
        limpiarFormModal();


        $('#btnProcesar').text('GUARDAR');
        $('#modalRegistropaqdestino .modal-title').text('Registro de nuevo Paquete destino');

        $('#modalRegistropaqdestino').modal('show');
    });



    $('#btnProcesar').click(function () {

        $("#registropaqdestino").submit();
    });


    $("#registropaqdestino").validate({
        // rules: {
        //     destino: "required",
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
            let url = route('paqdestino.store');
            let method = 'POST';

            const ID = $('#codigo_paqdestino').val();

            if (ID != 0) {

                url = route('paqdestino.update', { id: ID }); //que id va ahi
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

                    //VUELVE HABILITAR EL BUTON
                    $("#btnProcesar").html("Guardar").prop("disabled", false);

                    //LIMPIAR EL FORMULARIO
                    limpiarFormModal();

                    //CONSULTA LA DATA DEL SERVIDOR NUEVAMENTE!!
                    $('#formBusqueda').submit();
                    setTimeout(() => $("#btnProcesar").html("Guardar").prop("disabled", false), 1000);

                    //CIERRA EL MODAL ACTIVO
                    $('#modalRegistropaqdestino').modal('hide');

                    Swal.fire({
                        position: "top-center",
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500,
                    })
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
    $('#tablapaquetes_destinos').on('click', '.btnActualizar', function () {

        $('#btnProcesar').text('ACTUALIZAR');
        $('#modalRegistropaqdestino  .modal-title').text('Actualizar registro de Paquetes destinos');

        //CODIGO IDENTIFICADOR DEL REGISTRO
        const codigo = $(this).attr('codigo');
        const destino = $(this).attr('destino');
        const paquete_turistico = $(this).attr('paquete_turistico');

        //RUTA DE CONSULTA DEL ID DE EMPLEADO
        const $form = $('#registropaqdestino');
        $form.find('#codigo_paqdestino').val(codigo);
        $form.find('#paquete_turistico').val(paquete_turistico);
        $form.find('#destino').val(destino);
        
        $('#modalRegistropaqdestino').modal('show');
    });

    $('#tablapaquetes_destinos').on('click', '.btnBorrarRegistro', function () {

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
                url: route('paquetesdestino.delete', {id: codigo}),
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


});
