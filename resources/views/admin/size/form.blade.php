@csrf

@include('alerts.success')
@include('alerts.warning')

  <div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" class="form-control is-invalid" name="name" id="name" value=" {{ isset($size->SizeName) ? $size->SizeName : old('name') }}">

    @if ($errors->has('name'))
      <div class="invalid-feedback">
        {{ $errors->first('name') }}
      </div>
    @endif
  </div>

  <div class="form-group">
    <label for="clothingTypeId">Tipo de ropa</label>
    <select id="clothingTypeId" class="form-control is-invalid" name="clothingTypeId">
      <option value="" selected>- Seleccionar -</option>

        @foreach($clothingTypes as $item)
          <option value="{{ $item->ClothingTypeID }}"  {{ (isset($size->ClothingTypeID) && ($item->ClothingTypeID == $size->ClothingTypeID) || old('clothingTypeId'))  ? 'selected' : '' }} > {{ $item->ClothingTypeName }} </option>
        @endforeach
    </select>

    @if ($errors->has('clothingTypeId'))
      <div class="invalid-feedback">
        {{ $errors->first('clothingTypeId') }}
      </div>
    @endif
  </div>

  <div class="form-group">
    <label for="brandId">Marca</label>
    <select id="brandId" class="form-control is-invalid" name="brandId">
      <option value="" selected>- Seleccionar -</option>

        @foreach($brands as $item)
          <option value="{{ $item->BrandID }}"  {{ (isset($size->BrandID) && ($item->BrandID == $size->BrandID) || old('brandId'))  ? 'selected' : '' }} > {{ $item->BrandName }} </option>
        @endforeach
    </select>

    @if ($errors->has('brandId'))
      <div class="invalid-feedback">
        {{ $errors->first('brandId') }}
      </div>
    @endif
  </div>

  <div class="form-group">
    <label for="departmentId">Departamento</label>
    <select id="departmentId" class="form-control is-invalid" name="departmentId">
      <option value="" selected>- Seleccionar -</option>

        @foreach($departments as $item)
          <option value="{{ $item->DepartmentID }}"  {{ (isset($size->DepartmentID) && ($item->DepartmentID == $size->DepartmentID) || old('departmentId'))  ? 'selected' : '' }} > {{ $item->DepName }} </option>
        @endforeach
    </select>

    @if ($errors->has('departmentId'))
      <div class="invalid-feedback">
        {{ $errors->first('departmentId') }}
      </div>
    @endif
  </div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input is-invalid" type="checkbox" id="active" name="active" value="{{ (isset($size->Active) && $size->Active) ? 'true' : 'false'  }}" {{ (isset($size->Active) && $size->Active) ? 'checked' : ''  }}>
      <label class="form-check-label" for="active">
              Activo
      </label>
    </div>
  </div>

<button type="submit" class="btn btn-fr btn-block">Guardar</button>