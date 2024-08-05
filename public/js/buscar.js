//llenar la tabla al usar el buscador


$(document).ready(function(){


   /* $('#search').on('keyup', function(){
        var $value = $(this).val();
        $.ajax({
            type: 'get',
            url: '/buscar/search',
            data: {'search': $value},
            success: function(data){
                $('#tbody-resultados').empty();
                $.each(data, function(key, usuario){
                    var row = '<tr>';
                        row += '<td><input type="hidden" name="id" value="' + usuario.idusuario + '"></td>';
                        row += '<td>' + usuario.Nombres + '</td>';
                        row += '<td>' + usuario.Apellidos + '</td>';
                        row += '<td>' + usuario.Cargo + '</td>';
                        row += '<td>' + usuario.turno + '</td>';
                        row += '<td>' + usuario.Telefono + '</td>';
                        row += '<td>' + usuario.Domicilio + '</td>';
                        row += '<td>' + (usuario.HoraIngreso ? usuario.HoraIngreso : '') + '</td>';
                        row += '<td>' + (usuario.HoraSalida ? usuario.HoraSalida : '') + '</td>';
                        row += '<td>' +
                        '<a href="/Usuario/' + (usuario.idusuario ? usuario.idusuario : '') + '/edit" class="btn btn-sm">' +
                            'editar' +
                        '</a>' +
                        '<a class="btn btn-sm deleteBtn" onclick="alertaEliminar(' + (usuario.idusuario ? usuario.idusuario : '') + ')">' +
                            'eliminar' +
                        '</a>' +
                    '</td>';
                    row += '</tr>';
                    $('#tbody-resultados').append(row);
                });
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
            }
        });
    });*/

});