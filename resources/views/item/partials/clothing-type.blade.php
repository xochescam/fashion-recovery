<div class="form-group {{ $item ? 'w-100' : 'col-md-6' }}">
    <label for="ClothingTypeID">Tipo de prenda *</label>
    <select id="ClothingTypeID" class="form-control js-clothing-type-select" name="ClothingTypeID" data-clothing-types="{{ $clothingTypes }}" required>
      <option value="" selected>- Seleccionar -</option>
    </select>
    <small>Ejemplo: Blazer, Playera, Jeans...</small>

    @if ($errors->has('ClothingTypeID'))
        <div class="invalid-feedback">
          {{ $errors->first('ClothingTypeID') }}
        </div>
    @else
      <div class="invalid-feedback">
        El campo tipo de prenda es obligatorio.
      </div>
    @endif
  </div>