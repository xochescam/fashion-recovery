<div class="card mb-4">
  <h5 class="card-header">Datos de facturación</h5>

  <div class="card-body">

    <form method="POST" action="{{ url('billing-info',$invoice == null ? '' : $invoice->BillingInfoID) }}" class="needs-validation" novalidate>
      @csrf

      @if($invoice == null)

        <div class="alert alert-warning w-100" role="alert">
          No has actualizado tus datos de facturación. 

          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>
      @endif
        
      <div class="form-group row">
        <label for="Alias" class="col-sm-3 col-form-label text-right">Alias</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="Alias" id="Alias" value="{{ $invoice !== null ? $invoice->Alias : old('Alias') }}" maxlength="30" required>

          @if ($errors->has('Alias'))
            <div class="invalid-validation">
              {{ $errors->first('Alias') }}
            </div>
          @else
            <div class="invalid-feedback">
              El campo alias es obligatorio.
            </div>
          @endif
        </div>                      
      </div>

      <div class="form-group row">
        <label for="RFC" class="col-sm-3 col-form-label text-right">RFC</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="RFC" id="RFC" value="{{ $invoice !== null ? $invoice->RFC : old('RFC') }}" maxlength="13" required>

          @if ($errors->has('RFC'))
            <div class="invalid-validation">
              {{ $errors->first('RFC') }}
            </div>
          @else
            <div class="invalid-feedback">
              El campo RFC es obligatorio.
            </div>
          @endif
        </div>                      
      </div>

      <div class="form-group row">
        <label for="Street" class="col-sm-3 col-form-label text-right">Calle</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="Street" id="Street" value="{{ $invoice !== null ? $invoice->Street : old('Street') }}" maxlength="50" required>

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
        <label for="Suburb" class="col-sm-3 col-form-label text-right">Colonia</label>
        <div class="col-sm-9">
          <input type="Suburb" class="form-control" name="Suburb" id="Suburb" value="{{ $invoice !== null ? $invoice->Suburb : old('Suburb') }}" maxlength="50" required>

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
        <label for="ZipCode" class="col-sm-3 col-form-label text-right">Código postal</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="ZipCode" id="ZipCode" value="{{ $invoice !== null ? $invoice->ZipCode : old('ZipCode') }}" maxlength="5" required>

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
        <label for="State" class="col-sm-3 col-form-label text-right">Estado</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="State" id="State" value="{{ $invoice !== null ? $invoice->State : old('State') }}" maxlength="25" required>

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
        <label for="City" class="col-sm-3 col-form-label text-right">Ciudad</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="City" id="City" value="{{ $invoice !== null ? $invoice->City : old('City') }}" maxlength="25" required>

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
        <label for="Mail" class="col-sm-3 col-form-label text-right">Correo electrónico</label>
        <div class="col-sm-9">
          <input type="email" class="form-control" name="Mail" id="Mail" value="{{ $invoice !== null ? $invoice->Mail : old('Mail') }}" maxlength="80" required>

          @if ($errors->has('Mail'))
            <div class="invalid-validation">
              {{ $errors->first('Mail') }}
            </div>
          @else
            <div class="invalid-feedback">
              El campo correo electrónico es obligatorio.
            </div>
          @endif
        </div>                      
      </div>

      <div class="w-auto float-right">
        <button class="btn btn-fr">Guardar</button>
      </div>
    </form>
  </div>
</div>