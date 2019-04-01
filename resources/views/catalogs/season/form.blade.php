@csrf

@include('alerts.success')
@include('alerts.warning')

  <div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" class="form-control is-invalid" name="name" id="name" value=" {{ isset($season->SeasonName) ? $season->SeasonName : old('name') }}">

    @if ($errors->has('name'))
      <div class="invalid-feedback">
        {{ $errors->first('name') }}
      </div>
    @endif
  </div>

  <div class="form-group">

    <label for="periodStart">Fecha de inicio</label>
    <input type="date" class="form-control is-invalid date_time_input" name="periodStart" id="periodStart" value=" {{ isset($season->PeriodStart) ? $season->PeriodStart : old('periodStart') }}">

    @if ($errors->has('periodStart'))
      <div class="invalid-feedback">
        {{ $errors->first('periodStart') }}
      </div>
    @endif
  </div>

  <div class="form-group">
    <label for="periodEnd">Fecha de fin</label>
    <input type="date" class="form-control is-invalid date_time_input" name="periodEnd" id="periodEnd" value=" {{ isset($season->PeriodEnd) ? $season->PeriodEnd : old('periodEnd') }}">

    @if ($errors->has('periodEnd'))
      <div class="invalid-feedback">
        {{ $errors->first('periodEnd') }}
      </div>
    @endif
  </div>

  <div class="form-group">
    <label for="discount">Descuento</label>
    <input type="number" class="form-control is-invalid " name="discount" id="discount" value=" {{ isset($season->Discount) ? $season->Discount : old('discount') }}">

    @if ($errors->has('discount'))
      <div class="invalid-feedback">
        {{ $errors->first('discount') }}
      </div>
    @endif
  </div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input is-invalid" type="checkbox" id="active" name="active" value="{{ (isset($season->Active) && $season->Active) ? 'true' : 'false'  }}" {{ (isset($season->Active) && $season->Active) ? 'checked' : ''  }}>
      <label class="form-check-label" for="active">
              Activo
      </label>
    </div>
  </div>

<button type="submit" class="btn btn-fr btn-block">Guardar</button>