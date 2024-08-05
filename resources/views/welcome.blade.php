@extends('layout/plantilla1')

@section('titulo', 'Iniciar Sesion')

@section('content')

    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        {{--<img src="https://manoamano.s3.amazonaws.com/uploads/store/img_perfil/1797/laboratorio-san-pablo-perfil-c2446e1c45cc9aab.jpg"
                                            style="width: 185px;" alt="logo">--}}
                                            <img src="{{URL::asset('Imagenes/sanpabloicon.jpg')}}" alt="Logo" class="icono" style="width: 185px;">
                                        <h4 class="mt-1 mb-5 pb-1">Laboratorio San Paulo</h4>
                                    </div>

                                    @if (session('status'))
                                    <script>
                            
                                        Swal.fire({
                                        icon: 'error',
                                        title: 'Error: ',
                                        html: '{{session('status')}}',
                                        })
                                    </script>
                                @endif

    <form method="post" autocomplete="off" action="{{ url('/Usuario/IniciarSesion') }}">
    @csrf

    <div class="form-floating mb-4">
        <input type="text" name="usuario" id="usuario" class="form-control" value="{{ old('usuario') }}" placeholder="Usuario">
        <label for="floatingInput">Usuario</label>

        @error('usuario')
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <span>*{{$message}}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @enderror

    </div>

    <div class="form-floating mb-4">
        <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control" placeholder="Contraseña" />
        <label for="floatingInput">Contraseña</label>

        @error('password')
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <span>*{{$message}}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @enderror
    
    </div>

    <div class="text-center pt-1 mb-5 pb-1">
    <div class="float-start">
        <a class="text-muted" href="{{url('/Login')}}" style="font-size: 14px; background-color: #f8f9fa; padding: 6px 12px; border-radius: 5px;">¿Olvidaste tu contraseña?</a>        </div>
    <div class="float-end">
        <button class="btn btn-primary fa-lg gradient-custom-2" type="submit" style="font-size: 14px; padding: 5px 10px;">Ingresar</button>
    </div>
    <div class="clearfix"></div> <!-- Añadir clearfix para limpiar el float -->
</div>


</form>
                                   
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Alianzas a la medida</h4>
                                    <p class="small mb-0">En laboratorio de análisis clínicos San Pablo podrás encontrar
                                        una alianza de trabajo que se ajusten a las necesidades de la empresa, en
                                        beneficio a la seguridad, tener una detección oportuna y brindar protocolos de
                                        salud con tu personal.

                                        Contamos con 16 sucursales, ayudando a tener una fácil accesibilidad de
                                        ubicaciones para el paciente y poder brindar nuestro servicio más rápido y
                                        seguro. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
{{-- modal para restablecer el password --}}
@if (session('correoFlash'))
    @include('correo.modal_correo')
@endif

@endsection

