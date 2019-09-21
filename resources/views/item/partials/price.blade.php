<div class="form-row">
    <div class="form-group col-md-6">
      <label for="OriginalPrice">Precio original *</label>
      <input type="number" class="form-control" name="OriginalPrice" id="OriginalPrice" value="{{ ($item) ? $item->first()->OriginalPrice : '' }}" required>
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

      <input type="number" class="form-control" name="ActualPrice" id="ActualPrice" value="{{ ($item) ? $item->first()->ActualPrice : '' }}" required>
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