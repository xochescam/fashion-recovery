@csrf

@include('alerts.success')
@include('alerts.warning')

<div class="form-row">
  <div class="form-group col-md-6 d-block">

    <div class="custom-file">
{{--       <input type="file" class="custom-file-input is-invalid" id="SelfiePath" name="SelfiePath" lang="es"> --}}
      <p>Foto de perfil</p>
      <label class="custom-file-label custom-file-label--profile" for="SelfiePath">
        <input type="file" class="custom-file-input is-invalid" id="SelfiePath" name="SelfiePath" lang="es">
      </label>

      @if ($errors->has('SelfiePath'))
        <div class="invalid-feedback">
          {{ $errors->first('SelfiePath') }}
        </div>
      @endif
    </div>
  </div>
  <div class="form-group col-md-6">
      <label for="Greeting">Deja un saludo</label>
      <textarea name="Greeting" id="Greeting" class="form-control is-invalid" placeholder="Deja un saludo para que tú perfil sea confiable y amigable a tus posibles clientes">{{ isset($seller->Greeting) ? $seller->Greeting : old('Greeting') }}</textarea>

      @if ($errors->has('Greeting'))
        <div class="invalid-feedback">
          {{ $errors->first('Greeting') }}
        </div>
      @endif    
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-6">
      <label for="AboutMe">Acerca de mi</label>
      <textarea name="AboutMe" id="AboutMe" class="form-control is-invalid" placeholder="Escribe una breve descripción sobre ti; por ejemplo: ¿Por qué decidiste vender en Fashion Recovery?" rows="3">{{ isset($seller->AboutMe) ? $seller->AboutMe : old('AboutMe') }}</textarea>

      @if ($errors->has('AboutMe'))
        <div class="invalid-feedback">
          {{ $errors->first('AboutMe') }}
        </div>
      @endif
  </div>
  <div class="form-group col-md-6">
    <label for="LiveIn">Lugar de residencia</label>
    <select name="LiveIn" id="LiveIn" class="form-control is-invalid">
      <option value="" selected>- Seleccionar -</option>
      <option value="Aguascalientes" {{ old('LiveIn') == "Aguascalientes" ? "selected" : '' }}>
        Aguascalientes
      </option>
      <option value="Baja California" {{ old('LiveIn') == "Baja California" ? "selected" : '' }}>
        Baja California
      </option>
      <option value="Baja California Sur" {{ old('LiveIn') == "Baja California Sur" ? "selected" : '' }}>
        Baja California Sur
      </option>
      <option value="Campeche" {{ old('LiveIn') == "Campeche" ? "selected" : '' }}>
        Campeche
      </option>
      <option value="Chihuahua" {{ old('LiveIn') == "Chihuahua" ? "selected" : '' }}>
        Chihuahua
      </option>
      <option value="Chiapas" {{ old('LiveIn') == "Chiapas" ? "selected" : '' }}>
        Chiapas
      </option>
      <option value="Coahuila" {{ old('LiveIn') == "Coahuila" ? "selected" : '' }}>
        Coahuila
      </option>
      <option value="Colima" {{ old('LiveIn') == "Colima" ? "selected" : '' }}>
        Colima
      </option>
      <option value="Durango" {{ old('LiveIn') == "Durango" ? "selected" : '' }}>
        Durango
      </option>
      <option value="Guanajuato" {{ old('LiveIn') == "Guanajuato" ? "selected" : '' }}>
        Guanajuato
      </option>
      <option value="Guerrero" {{ old('LiveIn') == "Guerrero" ? "selected" : '' }}>
        Guerrero
      </option>
      <option value="Hidalgo" {{ old('LiveIn') == "Hidalgo" ? "selected" : '' }}>
        Hidalgo
      </option>
      <option value="Jalisco" {{ old('LiveIn') == "Jalisco" ? "selected" : '' }}>
        Jalisco
      </option>
      <option value="México" {{ old('LiveIn') == "México" ? "selected" : '' }}>
        México
      </option>
      <option value="Michoacán" {{ old('LiveIn') == "Michoacán" ? "selected" : '' }}>
        Michoacán
      </option>
      <option value="Morelos" {{ old('LiveIn') == "Morelos" ? "selected" : '' }}>
        Morelos
      </option>
      <option value="Nayarit" {{ old('LiveIn') == "Nayarit" ? "selected" : '' }}>
        Nayarit
      </option>
      <option value="Nuevo León" {{ old('LiveIn') == "Nuevo León" ? "selected" : '' }}>
        Nuevo León
      </option>
      <option value="Oaxaca" {{ old('LiveIn') == "Oaxaca" ? "selected" : '' }}>
        Oaxaca
      </option>
      <option value="Puebla" {{ old('LiveIn') == "Puebla" ? "selected" : '' }}>
        Puebla
      </option>
      <option value="Querétaro" {{ old('LiveIn') == "Querétaro" ? "selected" : '' }}>
        Querétaro
      </option>
      <option value="Quintana Roo" {{ old('LiveIn') == "Quintana Roo" ? "selected" : '' }}>
        Quintana Roo
      </option>
      <option value="San Luis Potosí" {{ old('LiveIn') == "San Luis Potosí" ? "selected" : '' }}>
        San Luis Potosí
      </option>
      <option value="Sinaloa" {{ old('LiveIn') == "Sinaloa" ? "selected" : '' }}>
        Sinaloa
      </option>
      <option value="Sonora" {{ old('LiveIn') == "Sonora" ? "selected" : '' }}>
        Sonora
      </option>
      <option value="Tabasco" {{ old('LiveIn') == "Tabasco" ? "selected" : '' }}>
        Tabasco
      </option>
      <option value="Tamaulipas" {{ old('LiveIn') == "Tamaulipas" ? "selected" : '' }}>
        Tamaulipas
      </option>
      <option value="Tlaxcala" {{ old('LiveIn') == "Tlaxcala" ? "selected" : '' }}>
        Tlaxcala
      </option>
      <option value="Veracruz" {{ old('LiveIn') == "Veracruz" ? "selected" : '' }}>
        Veracruz
      </option>
      <option value="Yucatán" {{ old('LiveIn') == "Yucatán" ? "selected" : '' }}>
        Yucatán
      </option>
      <option value="Zacatecas" {{ old('LiveIn') == "Zacatecas" ? "selected" : '' }}>
        Zacatecas
      </option>
    </select>

    @if ($errors->has('LiveIn'))
      <div class="invalid-feedback">
        {{ $errors->first('LiveIn') }}
      </div>
    @endif
  </div>

{{--   <div class="form-group col-md-6">
    <label for="WorkIn">Lugar de trabajo</label>
    <input type="text" class="form-control is-invalid" name="WorkIn" id="WorkIn" value="{{ isset($seller->WorkIn) ? $seller->WorkIn : old('WorkIn') }}">

    @if ($errors->has('WorkIn'))
      <div class="invalid-feedback">
        {{ $errors->first('WorkIn') }}
      </div>
    @endif
  </div> --}}
</div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="Phone">Teléfono</label>
    <input type="tel" name="Phone" id="Phone" class="form-control is-invalid" maxlength="10" value="{{ isset($seller->Phone) ? $seller->Phone : old('Phone') }}"></input>

    @if ($errors->has('Phone'))
      <div class="invalid-feedback">
        {{ $errors->first('Phone') }}
      </div>
    @endif
  </div>

  <div class="form-group col-md-6">
    <label>Documento de identificación</label>

    <div class="custom-file">
      <input type="file" class="custom-file-input is-invalid" id="IdentityDocumentPath" name="IdentityDocumentPath" lang="es">
      <label class="custom-file-label" for="IdentityDocumentPath">
        {{ isset($seller->IdentityDocumentPath) ? $seller->IdentityDocumentPath : (old('IdentityDocumentPath') ? old('IdentityDocumentPath') : 'Seleccionar archivo') }}
      </label>

      @if ($errors->has('IdentityDocumentPath'))
        <div class="invalid-feedback">
          {{ $errors->first('IdentityDocumentPath') }}
        </div>
      @endif
    </div>
  </div>
</div>

<div class="text-center mt-5">
  <button type="submit" class="btn btn-fr w-50">Registrarme</button>
</div>
