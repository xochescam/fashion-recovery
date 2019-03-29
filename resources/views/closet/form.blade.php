  @csrf

  @include('alerts.success')
  @include('alerts.warning')

    <div class="form-group">
      <label for="ClosetName">Nombre</label>
      <input type="text" class="form-control is-invalid" name="ClosetName" id="ClosetName" value=" {{ isset($closet->ClosetName) ? $closet->ClosetName : old('ClosetName') }}">

      @if ($errors->has('ClosetName'))
        <div class="invalid-feedback">
          {{ $errors->first('ClosetName') }}
        </div>
      @endif
    </div>

  <button type="submit" class="btn btn-fr btn-block">Guardar</button>