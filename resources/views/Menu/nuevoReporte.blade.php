@extends('layout/plantilla4')

@section('titulo', 'Reportes')

@section('sidebar')
{{--
<div id="content-wrapper" class="d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-light bg-white topbar mb-4 static-top shadow">
        <div class="container-fluid">
            <div class="row w-100 align-items-center">
                <div class="col-lg-11">
                    <div class="input-group">
                        <div class="col-lg-7 d-flex justify-content-center align-items-center">
                            <a class="navbar-brand" href="#" style="display: flex; align-items: center;">
                              <img src="{{URL::asset('Imagenes/sanpabloicon.jpg')}}" alt="Logo" class="icono" style="width: 55px; height: auto; margin-right: 20px;">  
                              <h1 class="display-6">Registro de Marcajes</h1>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                   
                    <a href="{{url('/Menu')}}" class="btn btn-outline-secondary float-end">Regresar</a>
                </div>
                
               
            <div class="col-lg-3 d-flex justify-content-end">
                <nav class="navbar navbar-light">
                    <ul class="navbar-nav">
                    </ul>
                </nav>
            </div>

            </div>
        </div>
    </nav>
</div>--}}

<div id="content-wrapper" class="d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-light bg-white topbar mb-4 static-top shadow">
        <div class="container-fluid">
            <div class="row w-100 align-items-center">
                <div class="col-lg-7">
                    <div class="input-group">
                        <div class="col-lg-12 d-flex justify-content-center align-items-center">
                            <a class="navbar-brand" href="#" style="display: flex; align-items: center;">
                                <img src="{{URL::asset('Imagenes/sanpabloicon.jpg')}}" alt="Logo" class="icono" style="width: 55px; height: auto; margin-right: 20px;">  
                                <h1 class="display-6">Registro de Marcajes</h1>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 d-flex justify-content-end align-items-center">
                   {{-- <a href="{{url('/Menu')}}" class="btn btn-outline-secondary float-end">Regresar</a>--}}

                   <a class="nav-link" aria-current="page" href="{{url('/Menu')}}">
                        <div class="icon-container rounded d-inline-flex align-items-center justify-content-center" style="background-color: #007c83; width: 70px; height: 40px;">
                            <img src="{{URL::asset('Imagenes/back.png')}}" alt="Icono Regresar" class="icono" style="width: 60px; height: 30px;">
                        </div> 
                        <span class="small d-block mt-1 text-sm" style="text-align: center;">Dashboard</span> 
                    </a>

                </div>

            </div>
        </div>
    </nav>
</div>



<div class="container">
    <div class="row">
        <div class="col-lg-3"></div> <!-- Espacio en blanco para alinear con el logo -->
        <div class="col-lg-9">
            {{-- buscar registros entre un rango de fechas --}}
            <div class="d-flex justify-content-center"> <!-- Utiliza d-flex y justify-content-center para centrar horizontalmente -->
                <form action="{{url('Reporte/Generar')}}" method="post" class="input-group"> 
                    {{ csrf_field() }}
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="inicio" class="col-form-label">De</label>
                        </div>
                        <div class="col-auto">
                            {{-- fecha de inicio--}}
                            <input type="date" name="fechaInicio" class="form-control" placeholder="Fecha de Inicio" required>
                            
                        </div>
                    </div>
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="fin" class="col-form-label">A la fecha</label>
                        </div>
                        <div class="col-auto">
                            {{-- fecha de fin--}}
                            <input type="date" name="fechaFin" class="form-control" placeholder="Fecha Final" required>
                            
                        </div>
                    </div>
                    <div class="col-lg-11"> <!-- Agrega margen top para mover el formulario hacia abajo -->
                      <button type="submit" name="btnBuscar" class="btn btn-outline-primary float-end" style="background-color: #007c83; color: white;">Aceptar</button>
                  </div>


                </form>
            </div>
        </div>
    </div>
</div>
@endsection




@section('content')
<div class="col-sm p-3 min-vh-100">
    <div class="container">
        <div class="row">
        <div class="col-2">
            {{-- --}}
        </div>
        <div class="col-8">

            {{-- en caso de que no exista un registro --}}

            @if (session('errorReporte'))

                <script>

                    Swal.fire({
                    icon: 'error',
                    title: 'Error: ',
                    html: '{{session('errorReporte')}}',
                    })

                </script>    

            @endif

            {{-- En caso de que el reporte se genere correctamente --}}

            @if (session('nuevoReporte'))

              @if($mesFinal < $mesInicial || $mesFinal >= $mesInicial && $diaFinal < $diaInicial)
                  
                    @if($mesFinal < $mesInicial)
                        <script>

                            Swal.fire({
                            icon: 'error',
                            title: 'Error: ',
                            html: '¡Advertencia! Por favor, asegúrate de ingresar las fechas en orden cronológico para obtener resultados precisos',
                            })
            
                          </script>  
                    @endif

                    @if ($mesFinal >= $mesInicial)
                        <script>

                            Swal.fire({
                            icon: 'error',
                            title: 'Error: ',
                            html: ' Por favor, asegúrate de ingresar las fechas en orden cronológico para obtener resultados precisos',
                            })
        
                      </script>  
                    @endif

                    @if ($diaFinal < $diaInicial)

                        <script>

                            Swal.fire({
                            icon: 'error',
                            title: 'Error: ',
                            html: ' Por favor, asegúrate de ingresar las fechas en orden cronológico para obtener resultados precisos',
                            })
            
                        </script>  
                        
                    @endif

              @else
                  
              <div style="text-align: left;">
              {{-- Abrirlo en otra pagina --}}
              <form action="{{url('Reporte/Descargar')}}" method="POST" target="_blank">
                  @csrf
                  <input type="hidden" name="fechaInicio" value="{{$FechaIni}}">
                  <input type="hidden" name="fechaFin" value="{{$FechaFin}}">
                  <button type="submit" name="enviar" class="btn btn-outline-danger" style="padding: 10px 20px; background: none; border: none;">
                  <div class="icon-container rounded d-inline-flex align-items-center justify-content-center" style="background-color: #007c83; width: 40px; height: 40px;"> <!-- Cambio de color de fondo -->
                    <img src="{{URL::asset('Imagenes/reporte.png')}}" alt="Icono Modificar" class="icono" style="width: 30px; height: 30px;"> <!-- Ajusta el tamaño de la imagen -->
                </div> 
                
                  </button>
              </form>
          </div>
                
                
                <div class="col-lg-10">
                    <table class="table table-bordered table-hover" style="width: 140%; border-radius: 10px; border-collapse: collapse; overflow: hidden; text-align: center;">
                        <thead>
                            <tr>
                                <th scope="col" style="background-color: #007c83; color: white; border-top-left-radius: 10px;">#</th>
                                <th scope="col" style="background-color: #007c83; color: white;">Nombre</th>
                                <th scope="col" style="background-color: #007c83; color: white;">Apellidos</th>
                                <th scope="col" style="background-color: #007c83; color: white;">Fecha</th>
                                <th scope="col" style="background-color: #007c83; color: white;">Hora Ingreso</th>
                                <th scope="col" style="background-color: #007c83; color: white; border-top-right-radius: 10px;">Hora Salida</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach ($lista as $index => $item)
                            <tr style="background-color: {{ $index % 2 == 0 ? '#dcdcdc' : 'transparent' }};">
                                <td></td>
                                <td>{{ $item->Nombres }}</td>
                                <td>{{ $item->Apellidos }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->Fecha)) }}</td>
                                <td>{{ date('H:i', strtotime($item->HoraIngreso)) }}</td>
                                <td>{{ date('H:i', strtotime($item->HoraSalida)) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
              @endif

            @endif

        </div>
        <div class="col-2"></div>
        </div>
  </div>
</div>

@endsection