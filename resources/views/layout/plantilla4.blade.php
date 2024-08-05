<!DOCTYPE html>
<html lang="en">

{{-- plantilla de Reportes --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- css de la tabla --}}
    <link rel="stylesheet" href="{{URL::asset('css/reportes.css')}}">

   

</head>
<body>

    @section('sidebar')
            
        @show

    <div class="container">
        @yield('content')
    </div>



    <footer>
        <div class="container-footer">
            <div class="attribution">
                <p class="parrafo-footer">Dirección: 350# San Salvador, 48300 Puerto Vallarta, Jal., Mexico | Teléfono: 322-888-4367</p>  
                <p class="parrafo-footer">&copy; Laboratorio San Pablo. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>