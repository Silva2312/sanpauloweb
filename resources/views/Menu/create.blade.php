@extends('layout/plantilla3')

@section('titulo', 'Insertar')

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
                    <h2 class="text-center">Nuevo Personal</h2>
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
        <div class="col-2"></div>
        <div class="col-8">

            {{-- Comprobar si hay errores de validación --}}
            @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form action="{{url('/Usuario')}}" method="post" autocomplete="off">
                {{-- evitar que aparesca el msg de pagina Expirada --}}
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    {{-- evitar perder la informacion ingresada previamente --}}
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="paterno" class="form-label">Apellido Paterno</label>
                    <input type="text" name="paterno" id="paterno" class="form-control" value="{{ old('paterno') }}" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="materno" class="form-label">Apellido Materno</label>
                    <input type="text" name="materno" id="materno" class="form-control" value="{{ old('materno') }}" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="domicilio" class="form-label">Domicilio</label>
                    <input type="text" name="domicilio" id="domicilio" class="form-control" value="{{ old('domicilio') }}" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="tel" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="codigo" class="form-label">Codigo</label>
                    <input type="number" name="codigo" id="codigo" class="form-control" value="{{ old('codigo') }}" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="cargo" class="form-label">Cargos</label>
                    <select class="form-select" name="cargo" id="cargo">
                        <option value="">Seleccione una opción</option>
                        @foreach ($cargos as $item)
                        @if ($item->IdCargo != 3)
                        <option value="{{ $item->IdCargo }}" {{ old('cargo') == $item->IdCargo ? 'selected' : '' }}>{{ $item->Cargo }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="horario" class="form-label">Horarios</label>
                    <select class="form-select" name="horario" id="horario">
                        <option value="">Seleccione una opción</option>
                        @foreach ($horarios as $horario)
                        <option value="{{ $horario->IdHorario }}" {{ old('horario') == $horario->IdHorario ? 'selected' : '' }}>{{ $horario->Turno }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Aceptar</button>
            </form>

        </div>
        <div class="col-2"></div>
    </div>
</div>

    
@endsection