<form method="POST" action="{{ url('shipping',$isNew ? '' : $address->ShippingAddID)  }}" class="needs-validation" novalidate>
   @csrf

   <input type="hidden" value="true" name="is_payment_process">

  <div class="form-group">
    <label for="Alias" class="col-form-label">Alias:</label>
      <input type="text" class="form-control" name="Alias" id="Alias" value="{{ $isNew ? '' : ($address->Alias ?: old('Alias')) }}" maxlength="30" required>
      <small>¿Cómo identificarás está dirección?</small>

      @if ($errors->has('Alias'))
        <div class="invalid-validation">
          {{ $errors->first('Alias') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo Alias es obligatorio.
        </div>
      @endif
  </div>

  <div class="form-group">
    <label for="Street" class="col-form-label">Calle:</label>
      <input type="text" class="form-control" name="Street" id="Street" value="{{ $isNew ? '' : ($address->Street ?: old('Street')) }}" maxlength="50" required>

      @if ($errors->has('Street'))
        <div class="invalid-validation">
          {{ $errors->first('Street') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo calle es obligatorio.
        </div>
      @endif
  </div>

  <div class="form-group">
    <label for="Suburb" class="col-form-label">Colonia:</label>
      <input type="Suburb" class="form-control" name="Suburb" id="Suburb" value="{{ $isNew ? '' : ($address->Suburb ?: old('Suburb')) }}" maxlength="50" required>

      @if ($errors->has('Suburb'))
        <div class="invalid-validation">
          {{ $errors->first('Suburb') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo colonia es obligatorio.
        </div>
      @endif
  </div>

  <div class="form-group">
    <label for="ZipCode" class="col-form-label">Código postal:</label>
      <input type="text" class="form-control" name="ZipCode" id="ZipCode" value="{{ $isNew ? '' : ($address->ZipCode ?: old('ZipCode')) }}" maxlength="5" required>
        <small>Ej. 23000</small>


      @if ($errors->has('ZipCode'))
        <div class="invalid-validation">
          {{ $errors->first('ZipCode') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo código postal es obligatorio.
        </div>
      @endif
  </div>

  <div class="form-group">
    <label for="State" class="col-form-label">Estado:</label>
      <input type="text" class="form-control" name="State" id="State" value="{{ $isNew ? '' : ($address->State ?: old('State')) }}" maxlength="25" required>

      @if ($errors->has('State'))
        <div class="invalid-validation">
          {{ $errors->first('State') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo estado es obligatorio.
        </div>
      @endif
  </div>

  <div class="form-group">
    <label for="City" class="col-form-label">Ciudad:</label>
      <input type="text" class="form-control" name="City" id="City" value="{{ $isNew ? '' : ($address->City ?: old('City')) }}" maxlength="25" required>

      @if ($errors->has('City'))
        <div class="invalid-validation">
          {{ $errors->first('City') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo ciudad es obligatorio.
        </div>
      @endif
  </div>

   <div class="form-group">
    <label for="PhoneContact" class="col-form-label">Teléfono:</label>
      <input type="tel" class="form-control" name="PhoneContact" id="PhoneContact" value="{{ $isNew ? '' : ($address->PhoneContact?: old('PhoneContact')) }}" maxlength="10" required>

      @if ($errors->has('PhoneContact'))
        <div class="invalid-validation">
          {{ $errors->first('PhoneContact') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo teléfono es obligatorio.
        </div>
      @endif
  </div>

  <div class="form-group">
    <label for="References" class="col-form-label">Referencias:</label>
      <input type="text" class="form-control" name="References" id="References" value="{{ $isNew ? '' : ($address->References ?: old('References')) }}" maxlength="100" required>
        <small>Ej. Edificio azul</small>


      @if ($errors->has('References'))
        <div class="invalid-validation">
          {{ $errors->first('References') }}
        </div>
      @else
        <div class="invalid-feedback">
          El campo referencias es obligatorio.
        </div>
      @endif

  </div>

  <div class="w-auto text-center">
    <button class="btn btn-fr w-50">
      <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
      Guardar
    </button>
  </div>
</form>