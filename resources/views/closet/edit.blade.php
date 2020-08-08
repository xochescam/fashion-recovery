<div class="modal fade" id="updateCollection-{{ $closet->ClosetID }}" tabindex="-1" role="dialog" aria-labelledby="updateCollection" aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="updateCollection">Edita tu colección</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('closet.update',$closet->ClosetID) }}" class="was-validated">
              @csrf

              <div class="form-group">
                <label for="ClosetName">Nombre</label>
                <input type="text" class="form-control" name="ClosetName" id="ClosetName" value="{{ isset($closet->ClosetName) ? $closet->ClosetName : old('ClosetName') }}" required>

                <div class="invalid-feedback">
                  El campo nombre es obligatorio
                </div>
              </div>

              <div class="form-group">
                <label for="ClosetDescription">Descripción</label>
                <textarea class="form-control" name="ClosetDescription" id="ClosetDescription" rows="3">{{ isset($closet->ClosetDescription) ? $closet->ClosetDescription : old('ClosetDescription') }}</textarea>

                <div class="invalid-feedback">
                  El campo descripción es obligatorio
                </div>
              </div>

              <div class="float-right w-100 mb-4">
                <div class="form-group m-0 row float-right">
                  <label class="col-form-label my-auto mr-2">Pausar colección</label>
                  <div class="col-form-label text-left d-flex align-top" >
                    <guardarropa-component
                      initial="{{ $closet->IsPaused }}"
                      type="colection"
                      item="{{ $closet->ClosetID }}"
                    ></guardarropa-component>
                  </div>
                </div>
              </div>

              <div class="text-center row">
                <div class="col-md-6 mb-3 mb-md-0">
                  <a href="{{ route('closet.destroy',$closet->ClosetID) }}" class="btn btn-danger w-100">
                    <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                    Eliminar
                  </a>
                </div>
                
                <div class="col-md-6">
                  <button class="btn btn-fr btn-block" type="submit">
                    <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                      Guardar
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
