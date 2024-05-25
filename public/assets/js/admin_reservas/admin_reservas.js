// const { createLogger } = require("vite");

$( function () {

    const PARAMETROS = {
        // URL_DATATABLE: route('vehiculos.getVehiculos'),

         //para poder borrar registros
         URL_DESTROY: (id) => route('reservashechas.destroy', { id_reserva: id })
   

    }
     
    //FUNCION PARA ELIMINAR REGISTROS

    $(function () {
        // Al hacer clic en el botón de eliminación
        $('.form-delete').on('submit', function (e) {
            e.preventDefault(); // Evitar que el formulario se envíe automáticamente
    
            const form = $(this);
            const url = form.attr('action');
    
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
                        type: "POST", // Laravel espera POST para la directiva @method('DELETE')
                        url: url,
                        data: form.serialize(), // Enviar todos los datos del formulario
                        success: function (response) {
                            Swal.fire(
                                'Eliminado!',
                                'La Reserva ha sido eliminada con éxito.',
                                'success'
                            ).then(() => {
                                // location.reload(); // Recargar la página para reflejar los cambios
                                window.location.href =  route('reservashechas.index'); // Redirigir a la ruta del índice
                            });
                        },
                        error: function (xhr, status, error) {
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

        //para el boton de actualizar fecha o estado de la reservacion 
        $('#vistadetallada').on('submit', function (e) {
            e.preventDefault(); // Evitar que el formulario se envíe automáticamente
            const form = $(this);
            const url = form.attr('action');
                    $.ajax({
                        type: "POST", 
                        url: url,
                        data: form.serialize(), // Enviar todos los datos del formulario
                        success: function (response) {
                            Swal.fire(
                                'Actualizado',
                                'La Reserva ha sido actualizada con éxito.',
                                'success'
                            ).then(() => {
                
                                window.location.href =  route('reservashechas.index'); // Redirigir a la ruta del índice
                            });
                        },
                        error: function (xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'Hubo un problema al actualizar el registro.',
                                'error'
                            );
                        }
                    });
      
            });
        });


    });
    




 
