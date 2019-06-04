@csrf

@include('alerts.success')
@include('alerts.warning')

  <div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" class="form-control" name="name" id="name" value=" {{ isset($color->ColorName) ? $color->ColorName : old('name') }}">

    @if ($errors->has('name'))
      <div class="invalid-feedback">
        {{ $errors->first('name') }}
      </div>
    @endif
  </div>

    <div class="form-group">
      <div class="form-check">
          <input class="form-check-input" type="checkbox" id="active" name="active" value="{{ (isset($color->Active) && $color->Active) ? 'true' : 'false'  }}" {{ isset($color->Active) ? ($color->Active == 1 ? 'checked' : '' ) : 'checked'}}>
          <label class="form-check-label" for="active">
              Activo
          </label>
    </div>
  </div>

<button type="submit" class="btn btn-fr btn-block">
  <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
  Guardar
</button>