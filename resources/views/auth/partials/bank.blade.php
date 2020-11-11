<div class="card mb-4">
  <h5 class="card-header">Información bancaria</h5>

  <div class="card-body">

    <form method="POST" action="{{ url('bank-info',$bank == null ? '' : $bank->BankID) }}" class="needs-validation" novalidate>
      @csrf

      @if($bank == null)

        <div class="alert alert-warning w-100" role="alert">
          No has actualizado tus información bancaria.

          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>
      @endif

        <div class="form-group row">
            <label for="bank" class="col-sm-3 col-form-label">Banco *</label>
            <div class="col-sm-9">
                <select name="bank" id="bank" class="form-control" required>
                    <option value="">- Seleccionar -</option>
                    @foreach($banks as $bank)
                      <option 
                        value="{{ $bank->BankID }}" {{ old('bank') == $bank->BankID || (isset($bank) && $bank->Bank == $bank->BankID) ? 'selected' : ''}}>
                          {{ $bank->BankDesc }}
                      </option>
                    @endforeach
                </select>

                @if ($errors->has('bank'))
                    <div class="invalid-validation">
                    {{ $errors->first('bank') }}
                    </div>
                @else
                    <div class="invalid-feedback">
                    El campo banco es obligatorio.
                    </div>
                @endif
            </div>
        </div>

      <div class="form-group row">
        <label for="clabe" class="col-sm-3 col-form-label">CLABE *</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="clabe" id="clabe" value="{{ $bank !== null ? $bank->Clabe : old('clabe') }}" maxlength="18" required>

          @if ($errors->has('clabe'))
            <div class="invalid-validation">
              {{ $errors->first('clabe') }}
            </div>
          @else
            <div class="invalid-feedback">
              El campo CLABE es obligatorio.
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