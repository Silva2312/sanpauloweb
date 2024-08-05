function alertaEliminar(codigo){

    if (!$('.deleteBtn').data('eventAttached')) {
  
    $('.deleteBtn').on('click', function() {
        var codigo = $(this).closest('tr').find('input[name="id"]').val();
        $.ajax({
            url: baseUrl2 +  '/delete/' + codigo + '/eliminar',
            method: 'GET',
            success: function(response) {
                $('#Id').val(response.idusuario);
                $('#Nom').val(response.Nombres);
                $('#Codigo').val(response.Codigo);
                $('#deleteModal').modal('show');
            },
            error: function(error) {
                console.error('Error al obtener los datos del usuario:', error);
            }
        });
    });
  
    $('.deleteBtn').data('eventAttached', true);
    }
}
/*
document.getElementById('eliminarRegistro').addEventListener('click', function(event) {
    event.preventDefault(); // Evita que el enlace se siga al hacer clic
    alertaEliminar(codigo);
});*/

  // Maneja el clic en el botón de cerrar del modal
$("#closeButton").click(function() {
    $('body').removeClass('modal-open');
    $('body').css('padding-left', '');
    $(".modal-backdrop").remove();
    $('#thank-you').hide();
});