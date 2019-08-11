@csrf

@include('alerts.success')
@include('alerts.warning')

  <div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" class="form-control" name="name" id="name" value="{{ isset($clothingType->ClothingTypeName) ? $clothingType->ClothingTypeName : old('name') }}" required>

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
    <select id="departmentId" class="form-control js-departments-select" name="departmentId" required data-size="false">
      <option value="" selected>- Seleccionar -</option>

        @foreach($departments as $item)
          <option value="{{ $item->DepartmentID }}"  {{ (isset($clothingType->DepartmentID) && ($item->DepartmentID == $clothingType->DepartmentID) || old('departmentId'))  ? 'selected' : '' }} > {{ $item->DepName }} </option>
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
    <select id="brandId" class="form-control js-brands-select" name="brandId"  data-size="false" required>
      <option value="" selected>- Seleccionar -</option>

        @foreach($brands as $item)
          <option value="{{ $item->BrandID }}"  {{ (isset($clothingType->BrandID) && ($item->BrandID == $clothingType->BrandID) || old('brandId'))  ? 'selected' : '' }} > {{ $item->BrandName }} </option>
        @endforeach
    </select>

    @if ($errors->has('brandId'))
      <div class="invalid-validation">
        {{ $errors->first('brandId') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo marca es obligatorio.
      </div>
    @endif
  </div>


  <div class="form-group">
    <label for="categoryId">Categoría</label>
    <select id="categoryId" class="form-control" name="categoryId" required>
      <option value="" selected>- Seleccionar -</option>

        @foreach($categories as $item)
          <option value="{{ $item->CategoryID }}"  {{ (isset($clothingType->CategoryID) && ($item->CategoryID == $clothingType->CategoryID) || old('categoryId'))  ? 'selected' : '' }} > {{ $item->CategoryName }} </option>
        @endforeach
    </select>

    @if ($errors->has('categoryId'))
      <div class="invalid-validation">
        {{ $errors->first('categoryId') }}
      </div>
    @else
      <div class="invalid-feedback">
        El categoría es obligatorio.
      </div>
    @endif
  </div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="active" name="active" value="{{ (isset($clothingType->Active) && $clothingType->Active) ? 'true' : 'false'  }}" {{ isset($clothingType->Active) ? ($clothingType->Active == 1 ? 'checked' : '' ) : 'checked'}}>
      <label class="form-check-label" for="active">
              Activo
      </label>
    </div>
  </div>

<button type="submit" class="btn btn-fr btn-block">
  <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
  Guardar
</button>