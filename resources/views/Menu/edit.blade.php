@extends('layout/plantilla3')

@section('titulo', 'Editar')

@section('sidebar')
<div id="content-wrapper" class="d-flex flex-column">
    <nav class="navbar navbar-expand-lg navbar-light bg-white topbar mb-4 static-top shadow">
        <div class="container-fluid">
            <div class="row w-100 align-items-center">
                <div class="col-lg-4">
                    <div class="input-group">
                        <a href="{{url('/Menu')}}" class="btn btn-outline-secondary">Go Back</a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <h2 class="text-center">Editar</h2>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </nav>
</div>
    
@endsection

@section('content')

<div class="container">
    <div class="row">
      <div class="col-2">
  
      </div>
      <div class="col-8">
    
    {{-- comprobar que no quede ningun espacio en blanco --}}
    @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            
            <ul>
                @foreach ($errors->all() as $validar)
                    <li>{{$validar}}</li>
                @endforeach
            </ul>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{url('/Usuario/'.$list->idusuario)}}" method="post" autocomplete="off">
        @method("PUT")
        @csrf

        <div class="mb-3">
            <label for="Nombre" class="form-label">Nombre</label>
                                                                                 {{-- evitar perder la info. agregada --}}
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre', $list->Nombres)}}">
        </div>

        <div class="mb-3">
            <label for="Nombre" class="form-label">Apellido Paterno</label>
            <input type="text" name="paterno" id="paterno" class="form-control" value="{{old('paterno', $list->Apellido1)}}">
        </div>

        <div class="mb-3">
            <label for="Nombre" class="form-label">Apellido Materno</label>
            <input type="text" name="materno" id="materno" class="form-control" value="{{old('materno', $list->Apellido2)}}">
        </div>

        <div class="mb-3">
            <label for="Nombre" class="form-label">Domicilio</label>
            <input type="text" name="domicilio" id="domicilio" class="form-control" value="{{old('domicilio', $list->Domicilio)}}">
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Telefono</label>
            <input type="tel" name="telefono" id="telefono" class="form-control" value="{{old('telefono', $list->Telefono)}}">
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Codigo</label>
            <input type="number" name="codigo" id="codigo" class="form-control" value="{{old('codigo', $list->Codigo)}}">
        </div>

        <div class="mb-3">
            <label for="proveedor">Cargo</label>
            <select class="form-select" aria-label="Default select example" name="cargo" id="cargo">
                <option value="">Seleccione una opcion</option>
                @foreach ($cargo as $item)

                    @if ($item->IdCargo != "3")
                        <option value="{{$item->IdCargo}}"  
                            {{-- valor de la base de datos --}}
                            @if ($item->IdCargo == $list->IdCargo) {{ 'selected' }} @endif 
                            {{-- guardar el valor seleccionado --}} 
                            @if( old('cargo')  == $item->IdCargo) selected="selected" @endif
                            >{{$item->Cargo}}
                        </option>
                    @endif
                @endforeach
              </select>
        </div>

        <div class="mb-3">
            <label for="proveedor">Turno</label>
            <select class="form-select" aria-label="Default select example" name="horario" id="horario">
                <option value="">Seleccione una opcion</option>
                @foreach ($horario as $item)
                    <option value="{{$item->IdHorario}}"  
                        @if ($item->IdHorario == $list->IdHorario) {{ 'selected' }} @endif
                        @if( old('horario')  == $item->IdHorario) selected="selected" @endif
                        >{{$item->Turno}}
                    </option>
                @endforeach
              </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
  </form>

</div>
<div class="col-2">
  
</div>
</div>
</div>
    
@endsection