function alertaActualizar(codigo) {
    if (!$('.updateBtn').data('eventAttached')) {
        $('.updateBtn').on('click', function() {
            var codigo = $(this).closest('tr').find('input[name="id"]').val();
            $.ajax({
               // url: baseUrl2 + '/delete/' + codigo + '/eliminar',
                url: baseUrl4 +  '/Usuario/' + codigo  + '/edit',
                method: 'GET',
                success: function(response) {
                    // Primera consulta AJAX
                    if (response && response.usuario) {
                        $('#Iden').val(response.usuario.idusuario);
                        $('#nombre').val(response.usuario.Nombres);
                        $('#paterno').val(response.usuario.Apellido1);
                        $('#materno').val(response.usuario.Apellido2);
                        $('#domicilio').val(response.usuario.Domicilio);
                        $('#telefono').val(response.usuario.Telefono);
                        $('#codigo').val(response.usuario.Codigo);
                        $('#actualizarModal').modal('show');
                    } else {
                        console.error('Los datos del usuario no están presentes en la respuesta.');
                    }
                    
                },
                error: function(error) {
                    console.error('Error al obtener los datos del usuario:', error);
                }
            });
        });

        $('.updateBtn').data('eventAttached', true);
    }
}
