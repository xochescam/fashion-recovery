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
    <label for="departmentId">Departamento</label>
    <select id="departmentId" class="form-control js-departments-select" name="departmentId" data-size="true" required>
      <option value="" selected>- Seleccionar -</option>

        @foreach($departments as $item)
          <option value="{{ $item->DepartmentID }}"  {{ (isset($size->DepartmentID) && ($item->DepartmentID == $size->DepartmentID) || old('departmentId'))  ? 'selected' : '' }} > {{ $item->DepName }} </option>
        @endforeach
    </select>

    @if ($errors->has('departmentId'))
      <div class="invalid-validation">
        {{ $errors->first('departmentId') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo departamento es obligatorio.
      </div>
    @endif
  </div>

  <div class="form-group">
    <label for="brandId">Marca</label>
    <select id="brandId" class="form-control js-brands-select" name="brandId" data-size="true">
      <option value="" selected>- Seleccionar -</option>

      @foreach($brands as $item)
          <option value="{{ $item->BrandID }}"  {{ (isset($size->BrandID) && ($item->BrandID == $size->BrandID) || old('categoryId'))  ? 'selected' : '' }} > {{ $item->BrandName }} </option>
      @endforeach

    </select>

    @if ($errors->has('brandId'))
      <div class="invalid-feedback">
        {{ $errors->first('brandId') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo marca es obligatorio.
      </div>
    @endif
  </div>

  <div class="form-group">
    <label for="clothingTypeId">Tipo de prenda</label>
    <select id="clothingTypeId" class="form-control js-clothing-type-select" name="clothingTypeId" data-size="true">
      <option value="" selected>- Seleccionar -</option>

      @foreach($clothingTypes as $item)
          <option value="{{ $item->ClothingTypeID }}"  {{ (isset($size->ClothingTypeID) && ($item->ClothingTypeID == $size->ClothingTypeID) || old('categoryId'))  ? 'selected' : '' }} > {{ $item->ClothingTypeName }} </option>
      @endforeach

    </select>

    @if ($errors->has('clothingTypeId'))
      <div class="invalid-feedback">
        {{ $errors->first('clothingTypeId') }}
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