@csrf

@include('alerts.success')
@include('alerts.warning')

  <div class="form-group">
    <label for="holiday">Festividad</label>
    <input type="text" class="form-control" name="holiday" id="holiday" value=" {{ isset($calendarSale->Holiday) ? $calendarSale->Holiday : old('holiday') }}">

    @if ($errors->has('holiday'))
      <div class="invalid-feedback">
        {{ $errors->first('holiday') }}
      </div>
    @endif
  </div>

  <div class="form-group">

    <label for="periodStart">Fecha de inicio</label>
    <input type="date" class="form-control date_time_input" name="periodStart" id="periodStart" value=" {{ isset($calendarSale->PeriodStart) ? $calendarSale->PeriodStart : old('periodStart') }}">

    @if ($errors->has('periodStart'))
      <div class="invalid-feedback">
        {{ $errors->first('periodStart') }}
      </div>
    @endif
  </div>

  <div class="form-group">
    <label for="periodEnd">Fecha de fin</label>
    <input type="date" class="form-control date_time_input" name="periodEnd" id="periodEnd" value=" {{ isset($calendarSale->PeriodEnd) ? $calendarSale->PeriodEnd : old('periodEnd') }}">

    @if ($errors->has('periodEnd'))
      <div class="invalid-feedback">
        {{ $errors->first('periodEnd') }}
      </div>
    @endif
  </div>

  <div class="form-group">
    <label for="discount">Descuento</label>
    <input type="number" class="form-control" name="discount" id="discount" value="{{ isset($calendarSale->Discount) ? $calendarSale->Discount : old('discount') }}">

    @if ($errors->has('discount'))
      <div class="invalid-feedback">
        {{ $errors->first('discount') }}
      </div>
    @endif
  </div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="active" name="active" value="{{ (isset($calendarSale->Active) && $calendarSale->Active) ? 'true' : 'false'  }}" {{ isset($calendarSale->Active) ? ($calendarSale->Active == 1 ? 'checked' : '' ) : 'checked'}}>
      <label class="form-check-label" for="active">
              Activo
      </label>
    </div>
  </div>

<button type="submit" class="btn btn-fr btn-block">
  <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
  Guardar
</button>