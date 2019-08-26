<div class="card mb-4">
  <h5 class="card-header">Dirección de envio</h5>

  <div class="card-body">

    <form method="POST" action="{{ url('shipping',$shipping == null ? '' : $shipping->ShippingAddID)  }}" class="needs-validation" novalidate>
       @csrf

      <input type="hidden" value="false" name="is_payment_process">


      @if($shipping == null && !$isPayment)

        <div class="alert alert-warning w-100" role="alert">
          No has actualizado tu dirección de envío.

          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>
      @endif

      <div class="form-group row">
        <label for="Alias" class="col-sm-3 col-form-label">Alias</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="Alias" id="Alias" value="{{ $shipping !== null ? $shipping->Alias : old('Alias') }}" maxlength="30" required>

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
      </div>

      <div class="form-group row">
        <label for="Street" class="col-sm-3 col-form-label">Calle</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="Street" id="Street" value="{{ $shipping !== null ? $shipping->Street : old('Street') }}" maxlength="50" required>

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
      </div>

      <div class="form-group row">
        <label for="Suburb" class="col-sm-3 col-form-label">Colonia</label>
        <div class="col-sm-9">
          <input type="Suburb" class="form-control" name="Suburb" id="Suburb" value="{{ $shipping !== null ? $shipping->Suburb : old('Suburb') }}" maxlength="50" required>

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
      </div>

      <div class="form-group row">
        <label for="ZipCode" class="col-sm-3 col-form-label">Código postal</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="ZipCode" id="ZipCode" value="{{ $shipping !== null ? $shipping->ZipCode : old('ZipCode') }}" maxlength="5" required>

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
      </div>

      <div class="form-group row">
        <label for="State" class="col-sm-3 col-form-label">Estado</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="State" id="State" value="{{ $shipping !== null ? $shipping->State : old('State') }}" maxlength="25" required>

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
      </div>

      <div class="form-group row">
        <label for="City" class="col-sm-3 col-form-label">Ciudad</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="City" id="City" value="{{ $shipping !== null ? $shipping->City : old('City') }}" maxlength="25" required>

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
      </div>

       <div class="form-group row">
        <label for="PhoneContact" class="col-sm-3 col-form-label">Teléfono</label>
        <div class="col-sm-9">
          <input type="tel" class="form-control" name="PhoneContact" id="PhoneContact" value="{{ $shipping !== null ? $shipping->PhoneContact : old('PhoneContact') }}" maxlength="10" required>

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
      </div>

      <div class="form-group row">
        <label for="References" class="col-sm-3 col-form-label">Referencias</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="References" id="References" value="{{ $shipping !== null ? $shipping->References : old('References') }}" maxlength="100" required>

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
      </div>

      <div class="w-auto float-right">
        <button class="btn btn-fr">
          <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
          Guardar
        </button>
      </div>
    </form>
  </div>
</div>