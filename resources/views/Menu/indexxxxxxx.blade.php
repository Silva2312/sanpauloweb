@extends('layout/plantilla2')

@section('titulo', 'Menu Principal')

@section('sidebar')

<div id="content-wrapper" class="d-flex flex-column">
  <nav class="navbar navbar-expand-lg navbar-light bg-white topbar mb-4 static-top shadow">
      <div class="container-fluid">
          <div class="row w-100 align-items-center">
              <div class="col-lg-7">
                  <div class="input-group">
                      <div class="col-lg-12 d-flex justify-content-center align-items-center">
                          <a class="navbar-brand" href="#" style="display: flex; align-items: center;">
                              <img src="{{URL::asset('Imagenes/sanpabloicon.jpg')}}" alt="Logo" class="icono" style="width: 55px; height: auto; margin-right: 20px;">  
                              <h1 class="display-6">Laboratorio San Paulo</h1>
                          </a>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3 d-flex justify-content-end align-items-center">
                  {{-- BOTON PARA INSERTAR NUEVO REGISTRO --}}
                  <a class="nav-link" aria-current="page" href="{{url('Usuario/create')}}">
                      <div class="icon-container rounded d-inline-flex align-items-center justify-content-center" style="background-color: #007c83; width: 40px; height: 40px;">
                          <img src="{{URL::asset('Imagenes/addpeople.png')}}" alt="Icono Agregar" class="icono" style="width: 30px; height: 30px;">
                      </div> 
                      <span class="small d-block mt-1 text-sm" style="text-align: center;">Insertar</span> 
                  </a>
                  {{-- BOTON PARA NUEVO SUPERVISOR --}}
                  <a class="nav-link" aria-current="page" href="{{url('/AgregarAdmin')}}">
                      <div class="icon-container rounded d-inline-flex align-items-center justify-content-center" style="background-color: #007c83; width: 40px; height: 40px;">
                          <img src="{{URL::asset('Imagenes/addpeople.png')}}" alt="Icono Agregar" class="icono" style="width: 30px; height: 30px;">
                      </div> 
                      <span class="small d-block mt-1 text-sm" style="text-align: center;">Supervisor</span>
                  </a>
                  {{-- BOTON PARA REPORTES --}}
                  <a class="nav-link" href="{{url('Reporte')}}" disabled="disabled">
                      <div class="icon-container rounded d-inline-flex align-items-center justify-content-center" style="background-color: #007c83; width: 40px; height: 40px;">
                          <img src="{{URL::asset('Imagenes/report.png')}}" alt="Icono Modificar" class="icono" style="width: 30px; height: 30px;">
                      </div> 
                      <span class="small d-block mt-1 text-sm" style="text-align: center;">Reportes</span> 
                  </a>

                  <div class="btn-group dropend">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <div class="d-inline-flex align-items-center justify-content-between" style="background-color: #eee; padding: 5px 10px; position: relative;"> <!-- Ajustado para iniciar en el borde izquierdo -->
                          <div class="icon-container rounded d-inline-flex align-items-center">
                              <img src="{{URL::asset('Imagenes/undraw_profile_2.svg')}}" alt="Gestion Cuenta" class="icono" style="width: 20px; height: 20px;"> <!-- Reducido el tamaño de la imagen -->
                          </div>
                          <span class="ml-2">{{session('usuario')}}</span>
                      </div>
                  </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                          <li><a class="dropdown-item" href="{{ url('/Configuracion') }}">Gestionar tu cuenta</a></li>
                          <li><a class="dropdown-item btn btn passwdBtn" href="{{url('/Password')}}">Cambiar Contraseña</a></li>
                          <li><a class="dropdown-item" href="#" id="logout">Cerrar Sesión</a></li>
                    </ul>
                  </div>

              </div>
          </div>
      </div>
  </nav>
</div>


  
  
  @endsection

  @section('content')

  <div class="container-fluid">
    <div class="row">
        
        <div class="col-sm p-3 min-vh-100">
            <!-- content -->

            {{-- BUSCADOR --}}
            
            <div class="container">
              <div class="row">
                
                <div class="col-lg-5">
                
                  <form method="post" autocomplete="off" action="{{url('/Usuario/Filtro')}}">
                    @csrf
                      <div class="input-group">
                        <input id="search" name="search" type="text" class="form-control rounded" placeholder="Search" style="width: 500px;" aria-label="Search" aria-describedby="search-addon" />
                      </div>
                  </form>
                
                </div> 
                <div class="col-lg-3">
                   
                    <div class="d-flex justify-content-center">
                      <center>
                        <H2>Dashboard</H2>
                        
                        <br>

                      </center>
                    </div>
                </div>
                <hr>
            </div>
            </div>

            {{-- --------------------------- TABLA -------------------------------- --}}

            <div class="container">
              <div class="row">
                <div class="col-0"></div>
                <div class="col-12">
                    <div class="table-container">
                    <table class="table-rounded">
                        <thead class="thead-light">
                            <tr> 
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Cargo</th>
                                <th scope="col">Turno</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Domicilio</th>
                                <th scope="col">Hora Ingreso</th>
                                <th scope="col">Hora Salida</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-resultados">

                            {{-- se va a borrar cuando se use el buscador --}}
                                @foreach ($lista as $index => $item)
                                <tr>
                                    <td><input type="hidden" name="id" value="{{$item->idusuario}}"></td>
                                    <td>{{$item->Nombres}}</td>
                                    <td>{{$item->Apellido1}} {{$item->Apellido2}}</td>
                                    <td>{{$item->Cargo}}</td>
                                    <td>{{$item->turno}}</td>
                                    <td>{{$item->Telefono}}</td>
                                    <td>{{$item->Domicilio}}</td>
                                    <td>{{$item->HoraIngreso}}</td>
                                    <td>{{$item->HoraSalida}}</td>
                                
                                    <td>
                                        <a href="{{url('/Usuario/'.$item->idusuario.'/edit')}}" class="btn btn-sm">
                                            <img src="{{URL::asset('Imagenes/editpeople.png')}}" alt="Icono Modificar" class="icono" width=30 height=30>
                                        </a>
                                        
                                        <a class="btn btn-sm deleteBtn" onclick="alertaEliminar({{$item->idusuario}})" id="eliminarRegistro">
                                            <img src="{{URL::asset('Imagenes/deletepeople.png')}}" alt="Icono Eliminar" class="icono" width=30 height=30>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            
                        </tbody>

                    </table>

                    </div>
                    <div class="row">
                        {{$lista->links()}}
                    </div>
                  </div>
                <div class="col-0"></div>
               </div>
              </div>
            </div>


        </div>
    </div>
</div>

{{-- ///////////////////////////////////////////////////////////////////////////////// --}}

{{-- para las opciones del buscador --}}
 
<script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
<script>
  $('#search').autocomplete({
  source: function(request, response) {
    $.ajax({
      url: "{{route('user.search')}}",
      dataType: 'json',
      data: {
        term: request.term
      },
      success: function(data){
        response(data)
      }
    });
  }
});
</script>

{{-- para el buscador de javascript--}}

<script>
//para los botones de eliminar y editar
var baseUrl3 = "{{ url('/') }}";
</script>

<script type="text/javascript">
/*
$('#search').on('keyup', function(){
    var $value = $(this).val();
    $.ajax({
        type: 'get',
        url: '{{ URL::to('/buscar/search') }}',
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
                      '<a href="' + baseUrl3 + '/Usuario/' + (usuario.idusuario ? usuario.idusuario : '') + '/edit" class="btn btn-sm">' +
                          '<img src="{{URL::asset('Imagenes/editpeople.png')}}" alt="Icono Modificar" class="icono" width=30 height=30>' +
                      '</a>' +
                      '<a class="btn btn-sm deleteBtn" onclick="alertaEliminar(' + (usuario.idusuario ? usuario.idusuario : '') + ')">' +
                          '<img src="{{URL::asset('Imagenes/deletepeople.png')}}" alt="Icono Eliminar" class="icono" width=30 height=30>' +
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
});

*/
</script>

<script type="text/javascript">
  $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

{{-- fin del buscador --}}

{{-- cerrar sesion --}}

<script>
//para evitar el mensaje 404 al dar clic en cerrar sesion
var baseUrl = "{{ url('/') }}";
</script>

<script>
//para el boton de eliminar registro
var baseUrl2 = "{{ url('/') }}";

var baseUrl4 = "{{ url('/') }}";
</script>

{{-- al cerrar sesion --}}
<script>
document.getElementById('logout').addEventListener('click', function(event) {
    event.preventDefault(); // Evita que el enlace se siga al hacer clic

    Swal.fire({
        title: '¿Seguro que desea cerrar sesión?',
        text: 'Si desea cerrar sesion pulse el botón "cerrar sesión".',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'cerrar sesión',
        cancelButtonText: 'cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = baseUrl + '/logout'; // Redirige al usuario a la ruta de cerrar sesión si confirma
        }
    });
});

</script>

<script>
  // Inicializar los popovers
  var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
  var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl);
  });
</script>

{{-- modal para cambiar contrase;a --}}
@include('Menu.modal_password')

{{-- modal para eliminar registros --}}

@include('Menu.modal_delete')

{{-- modal para insertar --}}

@if (session('addUser'))

@include('Menu.modal_insertar')

@endif

{{-- modal para actualizaciones --}}

@if (session('newRegister'))

@include('Menu.modal_update')

@endif

{{-- modal para gestion admin --}}

@if (session('newRegister_admin'))

@include('Menu.modal_update_admin')

@endif

@if (session('addAdmin'))

@include('Menu.modal_createAdmin')

@endif


@endsection

@section('piePagina')

        <footer>
        <div class="container-footer">
            <div class="attribution">
                <p class="parrafo-footer">Dirección: 350# San Salvador, 48300 Puerto Vallarta, Jal., Mexico | Teléfono: 322-888-4367</p>  
                <p class="parrafo-footer">&copy; Laboratorio San Pablo. Todos los derechos reservados.</p>
            </div>
        </div>
        </footer>

@endsection