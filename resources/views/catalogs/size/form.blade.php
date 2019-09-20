@csrf

@include('alerts.success')
@include('alerts.warning')

  <div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" class="form-control" name="name" id="name" value="{{ isset($size->SizeName) ? $size->SizeName : old('name') }}" required>

    @if ($errors->has('name'))
      <div class="invalid-validation">
        {{ $errors->first('name') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo nombre es obligatorio.
      </div>
    @endif
  </div>

  <div class="form-group">
    <label for="CategoryID">Categoría</label>
    <select id="CategoryID" class="form-control js-clothing-type-select" name="CategoryID" data-size="true">
      <option value="" selected>- Seleccionar -</option>

      @foreach($categories as $item)
          <option value="{{ $item->CategoryID }}"  {{ (isset($size->CategoryID) && ($item->CategoryID == $size->CategoryID) || old('CategoryID'))  ? 'selected' : '' }} > 
          {{ $item->CategoryName }} - {{ $item->DepName }}
          </option>
      @endforeach

    </select>

    @if ($errors->has('CategoryID'))
      <div class="invalid-feedback">
        {{ $errors->first('CategoryID') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo tipo de prenda es obligatorio.
      </div>
    @endif
  </div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="active" name="active" value="{{ (isset($size->Active) && $size->Active) ? 'true' : 'false'  }}" {{ isset($size->Active) ? ($size->Active == 1 ? 'checked' : '' ) : 'checked'}}>
      <label class="form-check-label" for="active">
              Activo
      </label>
    </div>
  </div>

<button type="submit" class="btn btn-fr btn-block">
  <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
  Guardar
</button>