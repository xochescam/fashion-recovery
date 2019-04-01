@csrf

@include('alerts.success')
@include('alerts.warning')

  <div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" class="form-control is-invalid" name="name" id="name" value=" {{ isset($category->CategoryName) ? $category->CategoryName : old('name') }}">

    @if ($errors->has('name'))
      <div class="invalid-feedback">
        {{ $errors->first('name') }}
      </div>
    @endif
  </div>

    <div class="form-group">
      <div class="form-check">
          <input class="form-check-input is-invalid" type="checkbox" id="active" name="active" value="{{ (isset($category->Active) && $category->Active) ? 'true' : 'false'  }}" {{ (isset($category->Active) && $category->Active) ? 'checked' : ''  }}>
          <label class="form-check-label" for="active">
              Activa
          </label>
    </div>
  </div>

<button type="submit" class="btn btn-fr btn-block">Guardar</button>