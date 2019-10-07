<div class="form-group col-md-6">
    <label for="BrandID">Marca *</label>

    <brands-component :options="{{ json_encode($brands) }}" :brand="DepartmentID" ></brands-component>

    @if ($errors->has('BrandID'))
      <div class="invalid-feedback">
        {{ $errors->first('BrandID') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo marca es obligatorio.
      </div>
    @endif
  </div>

  