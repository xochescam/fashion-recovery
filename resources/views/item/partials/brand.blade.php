<div class="form-group col-md-6">
    <label for="BrandID">Marca *</label>

    <brands-component :options="{{ json_encode($brands) }}" 
    :department="{{ isset($item->DepartmentID) ? $item->DepartmentID : 0 }}" 
    initial="{{ old('BrandID') ?  old('BrandID') : (isset($brand->BrandName)? $brand->BrandName : '') }}"></brands-component>

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

  