@extends('layout/plantilla4')

@section('title', 'Guardando Cambios')

@section('sidebar')

<div id="content-wrapper" class="d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-light bg-white topbar mb-4 static-top shadow">
        <div class="container-fluid">
            <div class="row w-100 align-items-center">
                <div class="col-lg-4">
                    <div class="input-group">
                        {{-- boton para volver al menu principal --}}
                        <a href="{{url('/')}}" class="btn btn-outline-secondary">Go Back</a>
                    </div>
                </div>
                <div class="col-lg-7">
                    {{-- Mensaje para confirmar Insercion, actualizacion o si se elimino un registro --}}
                    
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </nav>
</div>
    
@endsection

@section('content')

<script>
    //evitar msg de 404 al insertar, eliminar o actualizar un registro
    var baseUrl = "{{ url('/') }}";
</script>

    {{-- cuando se inserte, modifique o elimine un registro, va a aparecer esta pagina --}}

    @if (session('actualizar'))
    {{-- mensaje de error con sweet alert --}}
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Good Job: ',
            html: '{{ session('actualizar') }}',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = baseUrl + '/'; // Redirige a la página principal
            }
        });
    </script>
@endif
    
<h2 class="text-center">{{$msg}}</h2>
    

@endsection