<div class="form-row">
    <div class="form-group col-md-6">
      <label for="OriginalPrice">Precio original *</label>
      <input type="text" class="form-control" data-type="currency" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" name="OriginalPrice" id="OriginalPrice" 
      value="{{ old('OriginalPrice') ? old('OriginalPrice') : ($item && $item->OriginalPrice ? $item->OriginalPrice  : '' ) }}" required>
      <small>¿Cuánto te costo la prenda?</small>

      @if ($errors->has('OriginalPrice'))
        <div class="invalid-feedback">
          {{ $errors->first('OriginalPrice') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo precio original es obligatorio.
        </div>
      @endif
    </div>

    <div class="form-group col-md-6">
      <label for="ActualPrice">Precio actual *</label>

      <input type="text" class="form-control" data-type="currency" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" name="ActualPrice" id="ActualPrice" 
      value="{{ old('ActualPrice') ? old('ActualPrice') : ($item && $item->ActualPrice ? $item->ActualPrice  : '' ) }}" required>
      <small>¿En cuánto venderás la prenda?</small>

      @if($errors->first('ActualPrice'))
        <div class="invalid-feedback d-block">

          {{ $errors->first('ActualPrice') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo precio actual es obligatorio.
        </div>
      @endif
    </div>
  </div>