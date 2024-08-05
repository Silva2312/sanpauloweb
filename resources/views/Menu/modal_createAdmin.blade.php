@if (session('addAdmin'))

<script>
    $(document).ready(function() {
        $('#createModalAdmin').modal('show');
    });
</script>

<div class="modal fade" id="createModalAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <form action="{{ url('/NuevoAdmin') }}" method="post">
    @csrf

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Supervisor</h5>

                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>


            </div>

<div class="modal-body">

<div class="row">

    {{--@if (session('insert_errors'))

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
            
        <ul>
            @if (session('insert_error1'))
                <li>{{session('insert_error1')}}</li>
            @endif
            @if (session('insert_error2'))
                <li>{{session('insert_error2')}}</li>
            @endif
            @if (session('insert_error3'))
                <li>{{session('insert_error3')}}</li>
            @endif
            @if (session('insert_error4'))
                <li>{{session('insert_error4')}}</li>
            @endif
        </ul>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    @endif--}}

    <div class="col-md-6">

        <div class="mb-3">

            <label for="nombre" class="form-label fw-bold">Nombre de usuario</label>
            <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control bg-light" value="{{old('nombre_usuario')}}">
            <!-- Errores -->
            @error('nombre_usuario')
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <span>*{{$message}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @enderror
            @if (session('insert_error1'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @if (session('insert_error1'))
                        <li>{{session('insert_error1')}}</li>
                    @endif
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label fw-bold">Ingresa tu contraseña</label>
            {{-- evitar perder la informacion ingresada previamente --}}
            <input type="password" name="password2" id="password2" class="form-control" placeholder="Al menos una letra mayuscula y un numero" value="{{ old('password2') }}" autocomplete="off">
    
            @error('password2')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <spam>*{{$message}}</spam>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>                      
            @enderror
            @if (session('insert_error4'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @if (session('insert_error4'))
                        <li>{{session('insert_error4')}}</li>
                    @endif
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label fw-bold">Telefono</label>
            <input type="tel" name="telefono" id="telefono" class="form-control bg-light" value="{{old('telefono')}}">
          
            @error('telefono')
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <span>*{{$message}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @enderror
            @if (session('insert_error3'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @if (session('insert_error3'))
                        <li>{{session('insert_error3')}}</li>
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
            <input type="email" name="correo" id="correo" class="form-control bg-light" value="{{old('correo')}}">
          
            <!-- Errores -->
            @error('correo')
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <span>*{{$message}}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div >
            @enderror
            @if (session('insert_error2'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @if (session('insert_error2'))
                        <li>{{session('insert_error2')}}</li>
                    @endif
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
           @endif
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label fw-bold">Ingresa nuevamente tu contraseña</label>
            {{-- evitar perder la informacion ingresada previamente --}}
            <input type="password" name="password1" id="password1" class="form-control" placeholder="Al menos una letra mayuscula y un numero" value="{{ old('password1') }}" autocomplete="off">
    
            @error('password1')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <spam>*{{$message}}</spam>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>                      
            @enderror
            @if (session('insert_error4'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @if (session('insert_error4'))
                        <li>{{session('insert_error4')}}</li>
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
                <button type="submit" name="editData" class="btn" style="background-color: #019f6a; border-color: #007c83; color: #fff;">Aceptar</button>

            </div>
        </div>
    </div>
</form>
</div>

  <!-- Script para abrir el modal automáticamente -->
    @if ($errors->any())
    <script>
        $(document).ready(function() {
            $('#createModalAdmin').modal('show');
        });
    </script>
    @endif

@endif