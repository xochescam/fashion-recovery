<div class="form-group">
  <div class="form-check mt-2">
    <input class="form-check-input js-check-offer" type="checkbox" id="offer" name="offer"  value="true" {{ $item && $item->OffSaleID !== null || old('offer') ? 'checked' : '' }} >
    <label class="form-check-label" for="offer">¿Te gustaría agregar una oferta a la prenda?
    </label>
  </div>
</div>

<div class="card mb-4 js-check-container {{ $item && $item->OffSaleID !== null || old('offer') ? '' : 'hidden' }}">
  <div class="card-body">
    <div class="form-group">
      <label for="Discount">Descuento *</label>
      <input type="number" class="form-control" name="Discount" id="Discount" min="1" max="99" 
      value="{{ old('Discount') ? old('Discount') : ($item && $item->OffSaleID !== null ? $offers[$item->OffSaleID][0]->Discount : '') }}"  
      onKeyUp="if(this.value>99){this.value='99';}else if(this.value<0){this.value='1';}">
      <small>Escribe el porcentaje de descuento que le deseas aplicar a la prenda.</small>

      @if ($errors->has('Discount'))
        <div class="invalid-validation d-block">
          {{ $errors->first('Discount') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo descuento es obligatorio.
        </div>
      @endif
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="ValidFrom">Desde *</label>
        <input type="text" class="form-control date_input" name="ValidFrom" id="ValidFrom" 
        value="{{ old('ValidFrom') ? old('ValidFrom') : (isset($ValidFrom) && $ValidFrom !== '' ? $ValidFrom : '') }}" placeholder="dd/mm/aaaa" autocomplete="off">
        <small>Selecciona la fecha inicial de la oferta.</small>

        @if ($errors->has('ValidFrom'))
          <div class="invalid-validation">
            {{ $errors->first('ValidFrom') }}
          </div>
        @else
          <div class="invalid-feedback">
            El campo desde es obligatorio.
          </div>
        @endif
      </div>

      <div class="form-group col-md-6">
        <label for="ValidUntil">Hasta *</label>
        <input type="text" class="form-control date_input" name="ValidUntil" id="ValidUntil" 
        value="{{ old('ValidUntil') ? old('ValidUntil') : (isset($ValidUntil) && $ValidUntil !== '' ? $ValidUntil : '') }}" placeholder="dd/mm/aaaa" autocomplete="off">

        <small>Selecciona la fecha final de la oferta.</small>

        @if ($errors->has('ValidUntil'))
          <div class="invalid-validation">
            {{ $errors->first('ValidUntil') }}
          </div>
        @else
          <div class="invalid-feedback">
            El campo hasta es obligatorio.
          </div>
        @endif
      </div>
    </div>
  </div>
</div>