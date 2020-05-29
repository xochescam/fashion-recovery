<div class="form-row">
    <div class="form-group col-md-6">
      <label for="OriginalPrice">Precio Original *</label>
      <input type="text" class="form-control js-currency-input" data-type="currency" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" name="OriginalPrice" id="OriginalPrice" 
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
      <label for="ActualPrice">Precio Fashion Recovery *</label>

      <commission-component
        value="{{ old('ActualPrice') ? old('ActualPrice') : ($item && $item->ActualPrice ? $item->ActualPrice  : '' ) }}"
        :commission="{{ $commission }}"
      ></commission-component>

      @if($errors->first('ActualPrice'))
        <div class="invalid-feedback d-block">

          {{ $errors->first('ActualPrice') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo Precio Fashion Recovery es obligatorio.
        </div>
      @endif
    </div>
  </div>