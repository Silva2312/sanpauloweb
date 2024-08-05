<!DOCTYPE html>
<html lang="en">

{{-- Plantilla del Menu Principal --}}

<head>

    {{-- En la carpeta public, se agrego una carpeta js, css, y vendor --}}

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha384-gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    --}}


    {{-- librerias necesarias para el buscador --}}
    <link rel="icon" href="{{URL::asset('Imagenes/sanpabloicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{URL::asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}">

    <!-- Libreria necesaria para el boton de elimminar, tiene que estar al inicio, no al final -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    {{-- archivo eliminar js --}}
    <script src="{{URL::asset('js/eliminar.js')}}"></script>

    {{-- cambiar la contrase;a --}}
    <script src="{{URL::asset('js/contraseña.js')}}"></script>

    {{-- buscador --}}
    <script src="{{URL::asset('js/buscar.js')}}"></script>

    {{-- para insertar --}}
    <script src="{{URL::asset('js/insertar.js')}}"></script>

    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- css de la tabla --}}
    <link rel="stylesheet" href="{{URL::asset('css/index.css')}}">

    {{-- bootstrap icons --}}
    <!-- Option 1: Include in HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <meta name="_token" content="{{ csrf_token() }}">

</head>

<body>

    @yield('sidebar')

    @yield('content')

    @yield('piePagina')

{{--<center>
    <footer>
        <div class="container-footer">
            <div class="attribution">
              <p class="parrafo-footer">Dirección: 350# San Salvador, 48300 Puerto Vallarta, Jal., Mexico | Teléfono: 322-888-4367</p>  
              <p class="parrafo-footer">&copy; Laboratorio San Pablo. Todos los derechos reservados.</p>
            </div>
        </div>
      </footer>
</center>--}}
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>

    <script src="{{URL::asset('vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    

</html>