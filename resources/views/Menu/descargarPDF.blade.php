<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Descargar PDF</title>
    <link rel="stylesheet" href="{{URL::asset('css/descargarReporte.css')}}">
</head>
<body>
    <header>
        <div style="clear:both; position:relative; height: 100px;">
            <div style="position:absolute; left:0pt; width:64pt; height: 100px;">
                
                <a class="navbar-brand" href="#" style="display: flex; align-items: center;">
                    <img src="{{URL::asset('Imagenes/sanpabloicon.jpg')}}" alt="Logo" class="icono" style="width: 75px; height: auto; margin-right: 20px;">  
                  </a>
            </div>
            <div style="position:absolute; left:170pt; width:284pt; height: 100px;">
                <div class="lbl_info"><strong>Empresa: </strong>Laboratorio San Paulo</div>
                <div class="lbl_info"><strong>Direccion: </strong> San Salvador 350</div>
                <div class="lbl_info">48300 Puerto Vallarta, Jal., Mexico</div>
                <div class="lbl_info"><strong>Telefono:</strong> 322-888-4367</div>
            </div>
            <div style="position:absolute; right:0pt; width:114pt; height: 100px;">
        
                <div><strong>Fecha: </strong> {{date('d/m/Y')}}</div>
        
                <di><strong>Hora:</strong> {{date('h:i A')}} </div>
        
            </div>
          </div>
          <br>
            <hr>
        
            <h2 class="titulo">Reporte</h2>
        
            <hr>
    </header>
    <main>
        <br>
     <center>
  <div>
    <table>
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
</center>
    </main>
    <footer>
        <div class="container">
            {{--<div class="contact-info">
                <p>Dirección: 350# San Salvador, 48300 Puerto Vallarta, Jal., Mexico</p>
                <p>Teléfono: 322-888-4367</p>
            </div>--}}
            <div class="attribution">
 
                <p class="parrafo-footer">&copy; Laboratorio San Pablo. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    
</body>
</html>
