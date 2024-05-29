$(function () {

    //ENVIA EL TOKEN csrf A LA CABECERA DE FORMA AUTOMATICA
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const PARAMETROS = {
        URL_DATATABLE: route('encargadopaq.getEncargadospaquetes'),

        URL_DELETE: (id) => route('encargadopaq.delete', {id})
    }
    var dataTable = $('#tablaencargados_paquetes').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        // //se hace de esta manera el ajax por si da un error saber localizarlo
        //  ajax: {
        //    url: PARAMETROS.URL_DATATABLE,
        //    type: 'GET',
        //  data: $('#formBusqueda').serialize(),
        //  success: function(data) {
        //   dataTable.clear().draw();
        //    dataTable.rows.add(data).draw();
        //       },
        //       error: function(xhr, textStatus, errorThrown) {
        //           console.log(xhr.responseText);
        //           console.log(textStatus);
        //          console.log(errorThrown);
        //       }   
        //   },
         "ajax": `${PARAMETROS.URL_DATATABLE}?${$('#formBusqueda').serialize()}`,
         "language": {
         // "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
         },
        "columns": [

            // {title:'#', data: 'id'},
            {title: 'Fecha', data: 'Fecha'},
            { title: 'Nombre Paquete turistico', data: 'paquete_turistico' },
            { title: 'Empleado', data: 'Nombres' },
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
        $('#codigo_encargado').val('0');
        $('.limpiarForm').val('');
        $('.selectLimpiarForm').val('');
   
    }

    $('#btnNuevoRegistro').click(function () {
        limpiarFormModal();


        $('#btnProcesar').text('GUARDAR');
        $('#modalRegistropaqdestino .modal-title').text('Registro de Encargado paquete');

        $('#modalRegistroencargadopaq').modal('show');
    });



    $('#btnProcesar').click(function () {

        $("#registroencargado").submit();
    });


    $("#registroencargado").validate({
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
            let url = route('encargadopaq.store');
            let method = 'POST';

            const ID = $('#codigo_encargado').val();

            if (ID != 0) {

                url = route('encargadopaq.update', { id: ID }); //que id va ahi
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
                    $('#modalRegistroencargadopaq').modal('hide');

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
    $('#tablaencargados_paquetes').on('click', '.btnActualizar', function () {

        $('#btnProcesar').text('ACTUALIZAR');
        $('#modalRegistroencargadopaq  .modal-title').text('Actualizar registro de Encargado paquetes');

        //CODIGO IDENTIFICADOR DEL REGISTRO
        const codigo = $(this).attr('codigo');
        const fecha = $(this).attr('fecha');
        const paquete_turistico = $(this).attr('paquete_turistico');
        const empleado = $(this).attr('empleado');

        //RUTA DE CONSULTA DEL ID DE EMPLEADO
        const $form = $('#registroencargado');
        $form.find('#codigo_encargado').val(codigo);
        $form.find('#fecha').val(fecha);
        $form.find('#paquete_turistico').val(paquete_turistico);
        $form.find('#empleado').val(empleado);
        
        $('#modalRegistroencargadopaq').modal('show');
    });

    $('#tablaencargados_paquetes').on('click', '.btnBorrarRegistro', function () {

        const codigo = $(this).attr('codigo');
        const url = PARAMETROS.URL_DELETE(codigo);

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
                // url: route('encargadopaq.delete', {id: codigo}),
                url: url,
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
                error: function(xhr, textStatus, errorThrown) {
                               console.log(xhr.responseText);
                               console.log(textStatus);
                              console.log(errorThrown);
                           }   
            });
        });

    });


});
