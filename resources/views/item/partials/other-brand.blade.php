<div class="form-group {{ $item ? 'w-100' : 'col-md-6' }} js-other {{ isset($otherBrand) ? '' : 'hidden' }}">
    <label for="otherBrand">Ingresa la marca *</label>
    <input type="text" class="form-control" name="otherBrand" id="otherBrand" value="{{ isset($otherBrand->OtherBrand) ? $otherBrand->OtherBrand : '' }}">
    <small>Lorem ipsum dolor sit amet</small>

    @if ($errors->has('otherBrand'))
      <div class="invalid-validation">
        {{ $errors->first('otherBrand') }}
      </div>
    @else
      <div class="invalid-feedback">
        El campo ingresa la marca es obligatorio.
      </div>
    @endif
  </div>