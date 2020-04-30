
<div class="container">
  <div class="m-auto">
    
      <form method="POST" action="{{ url('seller',$seller->UserID) }}" class="needs-validation" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="row">

          <div class="col-md-6 pr-3">
            <div class="form-group row">
              <label for="Greeting" class="col-sm-3 col-form-label">Deja un saludo</label>
              <div class="col-sm-9">
                <textarea class="form-control" name="Greeting" id="Greeting"  cols="30" rows="3" max="50" required>{{ $seller->Greeting }}</textarea>

                @if ($errors->has('Greeting'))
                <div class="invalid-validation">
                  {{ $errors->first('Greeting') }}
                </div>
                @else
                <div class="invalid-feedback">
                  El campo deja un saludo es obligatorio.
                </div>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="AboutMe" class="col-sm-3 col-form-label">Acerca de mi</label>
              <div class="col-sm-9">
                <textarea class="form-control" name="AboutMe" id="AboutMe"  cols="30" rows="3" max="256" required>{{ $seller->AboutMe }}</textarea>
                @if ($errors->has('AboutMe'))
                <div class="invalid-validation">
                  {{ $errors->first('AboutMe') }}
                </div>
                @else
                <div class="invalid-feedback">
                  El campo acerca de mi es obligatorio.
                </div>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="Phone" class="col-sm-3 col-form-label">Teléfono</label>
              <div class="col-sm-9">
                <input type="tel" class="form-control" name="Phone" id="Phone"  maxlength="10" value="{{ $seller->Phone }}" required>

                @if ($errors->has('Phone'))
                <div class="invalid-validation">
                  {{ $errors->first('Phone') }}
                </div>
                @else
                <div class="invalid-feedback">
                  El campo teléfono es obligatorio.
                </div>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="LiveIn" class="col-sm-3 col-form-label">Lugar de residencia</label>
              <div class="col-sm-9">
                <select name="LiveIn" id="LiveIn" class="form-control" required>
                  <option value="" selected>- Seleccionar -</option>
                  <option value="Aguascalientes" {{ $seller->LiveIn == "Aguascalientes" ? "selected" : '' }}>
                    Aguascalientes
                  </option>
                  <option value="Baja California" {{ $seller->LiveIn == "Baja California" ? "selected" : '' }}>
                    Baja California
                  </option>
                  <option value="Baja California Sur" {{ $seller->LiveIn == "Baja California Sur" ? "selected" : '' }}>
                    Baja California Sur
                  </option>
                  <option value="Campeche" {{ $seller->LiveIn == "Campeche" ? "selected" : '' }}>
                    Campeche
                  </option>
                  <option value="Chihuahua" {{ $seller->LiveIn == "Chihuahua" ? "selected" : '' }}>
                    Chihuahua
                  </option>
                  <option value="Chiapas" {{ $seller->LiveIn == "Chiapas" ? "selected" : '' }}>
                    Chiapas
                  </option>
                  <option value="Ciudad de México" {{ $seller->LiveIn == "Ciudad de México" ? "selected" : '' }}>
                    Ciudad de México
                  </option>
                  <option value="Coahuila" {{ $seller->LiveIn == "Coahuila" ? "selected" : '' }}>
                    Coahuila
                  </option>
                  <option value="Colima" {{ $seller->LiveIn == "Colima" ? "selected" : '' }}>
                    Colima
                  </option>
                  <option value="Durango" {{ $seller->LiveIn == "Durango" ? "selected" : '' }}>
                    Durango
                  </option>
                  <option value="Estado de México" {{ old('LiveIn') == "Estado de México" ? "selected" : '' }}>
                  Estado de México
                </option>
                  <option value="Guanajuato" {{ $seller->LiveIn == "Guanajuato" ? "selected" : '' }}>
                    Guanajuato
                  </option>
                  <option value="Guerrero" {{ $seller->LiveIn == "Guerrero" ? "selected" : '' }}>
                    Guerrero
                  </option>
                  <option value="Hidalgo" {{ $seller->LiveIn == "Hidalgo" ? "selected" : '' }}>
                    Hidalgo
                  </option>
                  <option value="Jalisco" {{ $seller->LiveIn == "Jalisco" ? "selected" : '' }}>
                    Jalisco
                  </option>
                  <option value="México" {{ $seller->LiveIn == "México" ? "selected" : '' }}>
                    México
                  </option>
                  <option value="Michoacán" {{ $seller->LiveIn == "Michoacán" ? "selected" : '' }}>
                    Michoacán
                  </option>
                  <option value="Morelos" {{ $seller->LiveIn == "Morelos" ? "selected" : '' }}>
                    Morelos
                  </option>
                  <option value="Nayarit" {{ $seller->LiveIn == "Nayarit" ? "selected" : '' }}>
                    Nayarit
                  </option>
                  <option value="Nuevo León" {{ $seller->LiveIn == "Nuevo León" ? "selected" : '' }}>
                    Nuevo León
                  </option>
                  <option value="Oaxaca" {{ $seller->LiveIn == "Oaxaca" ? "selected" : '' }}>
                    Oaxaca
                  </option>
                  <option value="Puebla" {{ $seller->LiveIn == "Puebla" ? "selected" : '' }}>
                    Puebla
                  </option>
                  <option value="Querétaro" {{ $seller->LiveIn == "Querétaro" ? "selected" : '' }}>
                    Querétaro
                  </option>
                  <option value="Quintana Roo" {{ $seller->LiveIn == "Quintana Roo" ? "selected" : '' }}>
                    Quintana Roo
                  </option>
                  <option value="San Luis Potosí" {{ $seller->LiveIn == "San Luis Potosí" ? "selected" : '' }}>
                    San Luis Potosí
                  </option>
                  <option value="Sinaloa" {{ $seller->LiveIn == "Sinaloa" ? "selected" : '' }}>
                    Sinaloa
                  </option>
                  <option value="Sonora" {{ $seller->LiveIn == "Sonora" ? "selected" : '' }}>
                    Sonora
                  </option>
                  <option value="Tabasco" {{ $seller->LiveIn == "Tabasco" ? "selected" : '' }}>
                    Tabasco
                  </option>
                  <option value="Tamaulipas" {{ $seller->LiveIn == "Tamaulipas" ? "selected" : '' }}>
                    Tamaulipas
                  </option>
                  <option value="Tlaxcala" {{ $seller->LiveIn == "Tlaxcala" ? "selected" : '' }}>
                    Tlaxcala
                  </option>
                  <option value="Veracruz" {{ $seller->LiveIn == "Veracruz" ? "selected" : '' }}>
                    Veracruz
                  </option>
                  <option value="Yucatán" {{ $seller->LiveIn == "Yucatán" ? "selected" : '' }}>
                    Yucatán
                  </option>
                  <option value="Zacatecas" {{ $seller->LiveIn == "Zacatecas" ? "selected" : '' }}>
                    Zacatecas
                  </option>
                </select>

                @if ($errors->has('LiveIn'))
                <div class="invalid-validation">
                  {{ $errors->first('LiveIn') }}
                </div>
                @else
                <div class="invalid-feedback">
                  El campo acerca de mi es obligatorio.
                </div>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Documento de identificación</label>

              <div class="col-sm-9 col-form-label text-left">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="IdentityDocumentPath" name="IdentityDocumentPath" lang="es" value="{{ url($seller->IdentityDocumentPath) }}">
                  <label class="custom-file-label" for="IdentityDocumentPath">
                    @if(isset($seller->IdentityDocumentPath) || old('IdentityDocumentPath'))
                    <i class="fas fa-check green-color mr-1"></i>
                    <span class="green-color">Verificado</span>
                    @else
                    Seleccionar archivo
                    @endif
                  </label>



                  @if ($errors->has('IdentityDocumentPath'))
                  <div class="invalid-validation">
                    {{ $errors->first('IdentityDocumentPath') }}
                  </div>
                  @else
                  <div class="invalid-feedback">
                    El campo documento de identificación es obligatorio.
                  </div>
                  @endif
                </div>
              </div>
            </div>

            <div class="w-auto text-center">
              <button class="btn btn-fr">
                <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                Guardar
              </button>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Evaluaciones</label>
              <label class="col-sm-9 col-form-label text-left">{{ $seller->TotalEvaluations > 0 ? $seller->TotalEvaluations." evaluaciones." : "No cuenta con evaluaciones." }}</label>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Ventas</label>
              <label class="col-sm-9 col-form-label text-left">{{ $seller->ItemsSold > 0 ? $seller->ItemsSold." ventas." : "No cuenta con ventas." }}</label>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Prendas</label>
              <label class="col-sm-9 col-form-label text-left">{{ $items > 0 ? ($items == 1 ? $items." prenda subida." : $items." prendas subidas." ) : "No cuenta con prendas subidas." }}</label>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Devoluciones</label>
              <label class="col-sm-9 col-form-label text-left">{{ $seller->ItemsReturned > 0 ? $seller->ItemsReturned." devoluciones." : "No cuenta con devoluciones." }}</label>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Ranking</label>
              <div class="col-sm-9 col-form-label text-left">
                <i class="fas fa-star yellow"></i>
                <i class="fas fa-star yellow"></i>
                <i class="fas fa-star yellow"></i>
                <i class="far fa-star gray"></i>
                <i class="far fa-star gray"></i>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Mi cartera</label>
              <label class="col-sm-9 col-form-label text-left"> $0 </label>

            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Vendedor desde</label>
              <label class="col-sm-9 col-form-label text-left">{{ $sellerSince }}</label>
            </div>
          </div>
        </div>

      </form>
  </div>
</div>
