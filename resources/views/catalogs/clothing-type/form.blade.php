@csrf

@include('alerts.success')
@include('alerts.warning')

<div class="form-group">
    <label for="categoryId">Categoría</label>
    <select id="categoryId" class="form-control" name="categoryId" required>
      <option value="" selected>- Seleccionar -</option>

        @foreach($categories as $item)
          <option value="{{ $item->CategoryID }}"  {{ (isset($clothingType->CategoryID) && ($item->CategoryID == $clothingType->CategoryID) || old('categoryId'))  ? 'selected' : '' }} > 
          {{ $item->CategoryName }} - {{ $item->DepName }} 
          </option>
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