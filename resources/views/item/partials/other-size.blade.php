<div class="form-group {{ $item ? 'w-100' : 'col-md-6' }} js-other js-other-size {{ isset($otherBrand) ? '' : 'hidden' }}">
    <label for="OtherSize">Ingresa la talla *</label>
    <input type="text" class="form-control" name="OtherSize" maxlength="8" id="OtherSize" value="{{ isset($otherBrand->OtherSize) ? $otherBrand->OtherSize : '' }}" >
    <small>Lorem ipsum dolor sit amet</small>

    @if ($errors->has('OtherSize'))
      <div class="invalid-validation">
        {{ $errors->first('OtherSize') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo ingresa la talla es obligatorio.
      </div>
    @endif
  </div>