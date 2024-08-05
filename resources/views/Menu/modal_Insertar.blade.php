@if (session('addUser'))

<script>
    $(document).ready(function() {
        $('#createModal').modal('show');
    });
</script>

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{url('/Usuario')}}" method="post" autocomplete="off">
        @csrf
  
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Personal</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Campos de la izquierda -->
                            <div class="mb-3">
                
                                
                                <label for="nombre" class="form-label fw-bold">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control bg-light" value="{{old('nombre')}}">
                                <!-- Errores -->
                                @error('nombre')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <span>*{{$message}}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @enderror
                            </div>
                            <!-- Otros campos a la izquierda -->
                            <div class="mb-3">
                                <label for="paterno" class="form-label fw-bold">Apellido Paterno</label>
                                <input type="text" name="paterno" id="paterno" class="form-control bg-light" value="{{old('paterno')}}">
                                <!-- Errores -->
                                @error('paterno')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <span>*{{$message}}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @enderror
                            </div>
                            <!-- Otros campos a la izquierda -->
                            <div class="mb-3">
                                <label for="materno" class="form-label fw-bold">Apellido Materno</label>
                                <input type="text" name="materno" id="materno" class="form-control bg-light" value="{{old('materno')}}">
                                <!-- Errores -->
                                @error('materno')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <span>*{{$message}}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @enderror
                            </div>
                            <!-- Otros campos a la izquierda -->
                            <div class="mb-3">
                                <label for="domicilio" class="form-label fw-bold">Domicilio</label>
                                <input type="text" name="domicilio" id="domicilio" class="form-control bg-light" value="{{old('domicilio')}}">
                                <!-- Errores -->
                                @error('domicilio')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <span>*{{$message}}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Campos de la derecha -->
                            <div class="mb-3">
                                <label for="telefono" class="form-label fw-bold">Telefono</label>
                                <input type="tel" name="telefono" id="telefono" class="form-control bg-light" value="{{old('telefono')}}">
                                <!-- Errores -->
                                @error('telefono')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <span>*{{$message}}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @enderror
                            </div>
                            <!-- Otros campos a la derecha -->
                            <div class="mb-3">
                                <label for="codigo" class="form-label fw-bold">Codigo</label>
                                <input type="number" name="codigo" id="codigo" class="form-control bg-light" value="{{old('codigo')}}">
                                <!-- Errores -->
                                @error('codigo')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <span>*{{$message}}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @enderror
                            </div>
                            <!-- Otros campos a la derecha -->
                            <div class="mb-3">
                                <label for="cargo" class="form-label fw-bold">Cargos</label>
                                <select class="form-select bg-light" name="cargo" id="cargo">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($cargos as $item)
                                    {{--@if ($item->IdCargo != 3)--}}
                                    <option value="{{ $item->IdCargo }}" {{ old('cargo') == $item->IdCargo ? 'selected' : '' }}>{{ $item->Cargo }}</option>
                                    {{--@endif--}}
                                    @endforeach
                                </select>
                                  <!-- Errores -->
                              @error('cargo')
                                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                      <spam>*{{$message}}</spam>
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>                      
                              @enderror
                            </div>
                
                            <!-- Otros campos a la derecha -->
                            <div class="mb-3">
                                <label for="horario" class="form-label fw-bold">Turno</label>
                                <select class="form-select bg-light" name="horario" id="horario">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($horarios as $horario)
                                    <option value="{{ $horario->IdHorario }}" {{ old('horario') == $horario->IdHorario ? 'selected' : '' }}>{{ $horario->Turno }}</option>
                                    @endforeach
                                </select>
                                <!-- Errores -->
                                @error('horario')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <span>*{{$message}}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </form>
  </div>

  <!-- Script para abrir el modal automáticamente -->
    @if ($errors->any())
    <script>
        $(document).ready(function() {
            $('#createModal').modal('show');
        });
    </script>
    @endif

@endif
