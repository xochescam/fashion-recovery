  @csrf

  @include('alerts.success')
  @include('alerts.warning')

  <div class="form-group">
    <label for="ClosetName">Nombre</label>
    <input type="text" class="form-control" name="ClosetName" id="ClosetName" value="{{ isset($closet->ClosetName) ? $closet->ClosetName : old('ClosetName') }}" required>

      <div class="invalid-feedback">
        El campo nombre es obligatorio
      </div>
  </div>

  <div class="form-group">
    <label for="ClosetDescription">Descripción</label>
    <textarea class="form-control" name="ClosetDescription" id="ClosetDescription" rows="3" required>{{ isset($closet->ClosetDescription) ? $closet->ClosetDescription : old('ClosetDescription') }}</textarea>
    <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit officia commodi.</small>

      <div class="invalid-feedback">
        El campo descripción es obligatorio
      </div>
  </div>

  <button type="submit" class="btn btn-fr btn-block">Guardar</button>