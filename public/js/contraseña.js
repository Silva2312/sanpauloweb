function cambiarPassword(){
    $('.passwdBtn').on('click',function(){
        $('#passwordModal').modal('show');
    })
}

// Maneja el clic en el botón de cerrar del modal
$("#closeButton").click(function() {
    $('body').removeClass('modal-open');
    $('body').css('padding-left', '');
    $(".modal-backdrop").remove();
    $('#thank-you').hide();
});