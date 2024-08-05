{{-- MODAL PARA LA GESTION DEL ADMINSTRADOR --}}
@if (session('newRegister_admin'))

<script>
    $(document).ready(function() {
        $('#updateModal').modal('show');
    });
</script>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
        <form action="{{ url('/Gestion/Config') }}" method="post">
        @method("PUT")
        @csrf
    
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gestion Supervisor</h5>

                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>


                </div>
    
    <div class="modal-body">
   
    <div class="row">
        <div class="col-md-6">

            <div class="mb-3">

                
                <label for="nombre" class="form-label fw-bold">Nombre de usuario</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control bg-light" value="{{old('nombre_usuario', $admin->Nombre)}}">
                <!-- Errores -->
                @error('nombre_usuario')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <span>*{{$message}}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
                @if (session('gestion_error1'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <ul>
                        @if (session('gestion_error1'))
                            <li>{{session('gestion_error1')}}</li>
                        @endif
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label fw-bold">Telefono</label>
                <input type="tel" name="telefono" id="telefono" class="form-control bg-light" value="{{old('telefono', $admin->NumTelefono)}}">
              
                @error('telefono')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <span>*{{$message}}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
                @if (session('gestion_error3'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <ul>
                        @if (session('gestion_error3'))
                            <li>{{session('gestion_error3')}}</li>
                        @endif
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>

        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="nombre" class="form-label fw-bold">Correo</label>
                <input type="email" name="correo" id="correo" class="form-control bg-light" value="{{old('correo', $admin->Correo)}}">
              
                <!-- Errores -->
                @error('correo')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <span>*{{$message}}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
                @if (session('gestion_error2'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <ul>
                        @if (session('gestion_error2'))
                            <li>{{session('gestion_error2')}}</li>
                        @endif
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>
        </div>

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

@endif
