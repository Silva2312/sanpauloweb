@if (session('correoFlash'))

<script>
    $(document).ready(function() {
        $('#correoModal').modal('show');
    });
</script>

<div class="modal fade" id="correoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{url('/RecuperarPassword')}}" method="post" autocomplete="off">
        @csrf
  
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Recuperar Contraseña</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-bold">Ingresa tu contraseña</label>
                        {{-- evitar perder la informacion ingresada previamente --}}
                        <input type="email" name="correo" id="correo" class="form-control" placeholder="Ingresa tu contraseña" value="{{ old('correo') }}" autocomplete="off">

                        @error('correo')
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <spam>*{{$message}}</spam>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>                      
                        @enderror
                        @if (session('correo_error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <ul>
                                @if (session('correo_error'))
                                    <li>{{session('correo_error')}}</li>
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

@endif

{{--
--}}

    