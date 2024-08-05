@if (session('password'))

<script>
    $(document).ready(function() {
        $('#passwordModal').modal('show');
    });
</script>

<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{url('/ConfirmarPassword')}}" method="post" autocomplete="off">
        @csrf
  
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar Contraseña</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-bold">Ingresa tu contraseña</label>
                        {{-- evitar perder la informacion ingresada previamente --}}
                        <input type="password" name="passwd" id="passwd" class="form-control" placeholder="Ingresa tu contraseña" value="{{ old('passwd') }}" autocomplete="off">

                        @error('passwd')
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <spam>*{{$message}}</spam>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>                      
                        @enderror
                        @if (session('pass_actual'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <ul>
                                @if (session('pass_actual'))
                                    <li>{{session('pass_actual')}}</li>
                                @endif
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
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
                $('#passwordModal').modal('show');
            });
        </script>
        @endif

@endif


{{-- nuevo cuadro modal para ingresar la nueva contrase;a --}}
@if (session('cambiarPassword'))

<script>
    $(document).ready(function() {
        $('#NuevoPasswordModal').modal('show');
    });
</script>

<div class="modal fade" id="NuevoPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <form action="{{ url('/Password/NuevoPassword') }}" method="post">
    @csrf

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Contraseña</h5>

                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>


            </div>

<div class="modal-body">
    
    <div class="mb-3">
        <label for="nombre" class="form-label fw-bold">Ingresa tu contraseña</label>
        {{-- evitar perder la informacion ingresada previamente --}}
        <input type="password" name="passwd" id="passwd" class="form-control" placeholder="debe contener al menos una letra mayuscula y un numero" value="{{ old('passwd') }}" autocomplete="off">

        @error('passwd')
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <spam>*{{$message}}</spam>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>                      
        @enderror
        @if (session('pass_actual'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <ul>
                @if (session('pass_actual'))
                    <li>{{session('pass_actual')}}</li>
                @endif
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>

    <div class="mb-3">
        <label for="nombre" class="form-label fw-bold">Ingresa tu contraseña</label>
        {{-- evitar perder la informacion ingresada previamente --}}
        <input type="password" name="passwd2" id="passwd2" class="form-control" placeholder="debe contener al menos una letra mayuscula y un numero" value="{{ old('passwd2') }}" autocomplete="off">

        @error('passwd2')
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <spam>*{{$message}}</spam>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>                      
        @enderror
        @if (session('pass_actual'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <ul>
                @if (session('pass_actual'))
                    <li>{{session('pass_actual')}}</li>
                @endif
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

    </div>

</div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" name="editData" class="btn" style="background-color: #019f6a; border-color: #007c83; color: #fff;">Actualizar registro</button>

            </div>
        </div>
    </div>
</form>
</div>

<!-- Script para abrir el modal automáticamente -->
@if ($errors->any())
<script>
    $(document).ready(function() {
        $('#NuevoPasswordModal').modal('show');
    });
</script>
@endif


@endif