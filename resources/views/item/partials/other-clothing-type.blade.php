<div class="form-group w-100">
    <label for="OtherClothingType">Ingresa el tipo de prenda *</label>
    <input type="text" class="form-control" name="OtherClothingType" id="OtherClothingType" value="{{ isset($otherBrand->OtherClothingType) ? $otherBrand->OtherClothingType : '' }}">
    <small>Lorem ipsum dolor sit amet</small>

    @if ($errors->has('OtherClothingType'))
      <div class="invalid-validation">
        {{ $errors->first('OtherClothingType') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo ingresa el tipo de prenda es obligatorio.
      </div>
    @endif
  </div>