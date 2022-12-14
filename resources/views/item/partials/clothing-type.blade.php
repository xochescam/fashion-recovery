<div class="form-group col-md-6">
    <label for="ClothingTypeID">Tipo de prenda *</label>
    <select id="ClothingTypeID" class="form-control js-clothing-type-select" name="ClothingTypeID" data-clothing-types="{{ $clothingTypes }}" data-clothing-type="{{ old('ClothingTypeID') ?  old('ClothingTypeID') : ($item ? $item->ClothingTypeID : false) }}" required>
      <option value="">- Seleccionar -</option>

      @if($item)
        @foreach( (old('CategoryID') ? $clothingTypes[old('CategoryID')] : $clothingTypes[$item->CategoryID]) as $clothingType )

          <option value="{{ $clothingType->ClothingTypeID }}"  
            {{ old('ClothingTypeID') && (old('ClothingTypeID') == $clothingType->ClothingTypeID) ? 'selected' :  ($item && ($clothingType->ClothingTypeID == $item->ClothingTypeID) ? 'selected' : '') }}>
            {{ $clothingType->ClothingTypeName }}
          </option>

        @endforeach
      @endif

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