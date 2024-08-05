{{-- MODAL PARA ELIMINAR UN REGISTRO --}}

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{url('/Usuario/'.$item->idusuario)}}" method="post">
        @method("DELETE")
        @csrf
  {{--  url('/Usuario/'.$item->idusuario)}} 
  --}}
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Desea eliminar el registro?</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Una vez eliminado, no se podrá revertir esta acción.</p>
                    <div class="form-group">
                        <label for="Nom" class="form-label">Nombre:</label>
                        <input type="text" id="Nom" name="Nom" class="form-control" readonly>

                        <label for="Nom" class="form-label">Codigo:</label>
                        <input type="text" id="Codigo" name="Codigo" class="form-control" readonly>

                        <input type="hidden" id="Id" name="Id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" name="deleteData" class="btn" style="background-color: #ff431d; border-color: #007c83; color: #fff;">Eliminar</button>
                </div>
            </div>
        </div>
    </form>
  </div>