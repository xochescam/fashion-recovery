@csrf

@include('alerts.success')
@include('alerts.warning')

<div class="form-group">
  <label for="Greeting">Saludo</label>
  <textarea name="Greeting" id="Greeting" class="form-control is-invalid">{{ isset($seller->Greeting) ? $seller->Greeting : old('Greeting') }}</textarea>

  @if ($errors->has('Greeting'))
    <div class="invalid-feedback">
      {{ $errors->first('Greeting') }}
    </div>
  @endif
</div>

<div class="form-group">
  <label for="AboutMe">Acerca de mi</label>
  <textarea name="AboutMe" id="AboutMe" class="form-control is-invalid">{{ isset($seller->AboutMe) ? $seller->AboutMe : old('AboutMe') }}</textarea>

  @if ($errors->has('AboutMe'))
    <div class="invalid-feedback">
      {{ $errors->first('AboutMe') }}
    </div>
  @endif
</div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="LiveIn">Lugar de residencia</label>
    <input type="text" class="form-control is-invalid" name="LiveIn" id="LiveIn">

    @if ($errors->has('LiveIn'))
      <div class="invalid-feedback">
        {{ $errors->first('LiveIn') }}
      </div>
    @endif
  </div>

  <div class="form-group col-md-6">
    <label for="WorkIn">Lugar de trabajo</label>
    <input type="text" class="form-control is-invalid" name="WorkIn" id="WorkIn">

    @if ($errors->has('WorkIn'))
      <div class="invalid-feedback">
        {{ $errors->first('WorkIn') }}
      </div>
    @endif
  </div>
</div>

<div class="form-row">

  <div class="form-group col-md-6">
    <label for="IdentityDocumentPath">Documento de identificación</label>
    <input type="file" class="form-control-file is-invalid" id="IdentityDocumentPath" name="IdentityDocumentPath">

    @if ($errors->has('IdentityDocumentPath'))
      <div class="invalid-feedback">
        {{ $errors->first('IdentityDocumentPath') }}
      </div>
    @endif
  </div>

  <div class="form-group col-md-6">
    <label for="SelfiePath">Foto de perfil</label>
    <input type="file" class="form-control-file is-invalid" id="SelfiePath" name="SelfiePath">

    @if ($errors->has('SelfiePath'))
      <div class="invalid-feedback">
        {{ $errors->first('SelfiePath') }}
      </div>
    @endif
  </div>
</div>

<button type="submit" class="btn btn-fr btn-block">Crear Cuenta</button>