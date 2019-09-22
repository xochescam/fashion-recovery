<div class="form-group w-100 js-other-brand {{  $item && $item->OtherBrand ? '' : 'hidden' }}">
    <label for="otherBrand">Ingresa la marca *</label>
    <input type="text" class="form-control" name="otherBrand" value="{{ $item && $item->OtherBrand ? $brand->BrandName : '' }}">
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