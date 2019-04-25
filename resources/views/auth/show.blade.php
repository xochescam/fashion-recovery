@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">

          <div class="w-100">
            <h2 class="text-center TituloFR my-4 mb-5">Mi cuenta</h2>

            @include('alerts.success')
            @include('alerts.warning')
          </div>

          <div class="col-md-3 text-center">

            @if(Auth::User()->ProfileID == 2)

              <form method="POST" action="{{ url('update-selfie',Auth::User()->id) }}" class="mb-5" enctype="multipart/form-data">
                @csrf

                <label for="SelfiePath" class="mb-2">
                  <div class="card card--selfie ">
                    <img src=" {{ url($seller->SelfieThumbPath) }} " class="card-img-top js-selfie-img" alt="">
                    <i class="far fa-edit" id="edit_icon"></i>
                  </div>
                  <input type="file" class="selfieInput no-file js-selfie-input" id="SelfiePath" name="SelfiePath">
                </label>
                
                <div class="text-center">
                  <button class="btn btn-fr hidden js-selfie-btn">Actualizar</button>
                </div>
              </form>

            @endif

            <ul class="list-group list-group-flush">
              <a href="#" class="list-group-item list-group-item-action text-left">
                Mis datos
              </a>
              <a href="#" class="list-group-item list-group-item-action text-left">
                Mis preferencias
              </a>
              <a href="#" class="list-group-item list-group-item-action text-left">
                Wish Lists
              </a>
              <a href="#" class="list-group-item list-group-item-action text-left">
                Mis pedidos
              </a>
              <a href="#" class="list-group-item list-group-item-action text-left">
                Mis tickets
              </a>
            </ul>
          </div>

          <div class="col-md-9 ">
              <div class="card mb-4">
                <h5 class="card-header">Datos personales</h5>

                <div class="card-body">
{{--                   <div class="w-auto float-right mb-4">
                    <a class="btn btn-fr" href="{{ url('auth/'.(Auth::User()->id).'/edit') }}" role="button">Modificar datos</a>
                  </div> --}}

                  <form method="POST" action="{{ url('auth',Auth::User()->id) }}" class="needs-validation" novalidate>
                     @csrf
                      
                    <div class="form-group row">
                      <label for="Alias" class="col-sm-3 col-form-label text-right">Alias</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="Alias" id="Alias" value="{{ Auth::User()->Alias }}" required>

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
                      <label for="Name" class="col-sm-3 col-form-label text-right">Nombre</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="Name" id="Name" value="{{ Auth::User()->Name }}">

                        @if ($errors->has('Name'))
                          <div class="invalid-validation">
                            {{ $errors->first('Name') }}
                          </div>
                        @endif
                      </div>
                    </div>

                     <div class="form-group row">
                      <label for="last_name" class="col-sm-3 col-form-label text-right">Apellidos</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="last_name" id="last_name" value="{{ Auth::User()->Lastname }}">

                        @if ($errors->has('last_name'))
                          <div class="invalid-validation">
                            {{ $errors->first('last_name') }}
                          </div>
                        @endif
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="email" class="col-sm-3 col-form-label text-right">Correo electrónico</label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" id="email" value="{{ Auth::User()->email }}" required>

                        @if ($errors->has('email'))
                          <div class="invalid-validation">
                            {{ $errors->first('email') }}
                          </div>
                        @else
                          <div class="invalid-feedback">
                            Ingresa un correo electrónico válido.
                          </div>
                        @endif

                      </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-right" for="gender">Género</label>
                        <div class="col-sm-9">
                          <select id="gender" class="form-control" name="gender" >
                            <option value="" selected>- Seleccionar -</option>
                            <option value="Masculino" {{ Auth::User()->Gender == 'Masculino' || old('gender') == 'Masculino' ? 'selected' : ''}}>Masculino</option>
                            <option value="Femenino" {{ Auth::User()->Gender == 'Femenino' ||old('gender') == 'Femenino' ? 'selected' : ''}}>Femenino</option>
                            <option value="Indefinido" {{ Auth::User()->Gender == 'Indefinido' || old('gender') == 'Indefinido' ? 'selected' : ''}}>Indefinido</option>
                          </select>

                          @if ($errors->has('gender'))
                            <div class="invalid-feedback">
                              {{ $errors->first('gender') }}
                            </div>
                          @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="birth_date" class="col-sm-3 col-form-label text-right">Fecha de nacimiento</label>
      
                      <div class="form-group col-md-9">
                        <input type="text" class="form-control date_input" id="birth_date" name="birth_date" max="{{ date("Y-m-d") }}" placeholder="dd/mm/aaaa" value="{{ old('birth_date') || Auth::User()->Birthdate ? $birthDateUser : old('birth_date') }}"  onblur="(this.type='text')" onfocus="(this.type='date')">

                        @if ($errors->has('birth_date'))
                          <div class="invalid-feedback">
                            {{ $errors->first('birth_date') }}
                          </div>
                        @endif
                      </div>

                    </div>

                     <div class="form-group row">
                      <label class="col-sm-3 col-form-label text-right">Miembro desde</label>
                      <label class="col-sm-9 col-form-label text-left">{{ $creationDateUser }}</label>
                    </div>

                    <div class="w-auto float-right">
                      <button class="btn btn-fr">Guardar</button>
                    </div>
                  </form>
                </div>
              </div>

            @if(Auth::User()->ProfileID == 2)
                <div class="card">
                  <h5 class="card-header">Ventas</h5>

                  <div class="card-body">

                  <form method="POST" action="{{ url('seller',$seller->UserID) }}" class="needs-validation" enctype="multipart/form-data" novalidate>
                     @csrf

                      <div class="form-group row">
                        <label for="Greeting" class="col-sm-3 col-form-label text-right">Deja un saludo</label>
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
                        <label for="AboutMe" class="col-sm-3 col-form-label text-right">Acerca de mi</label>
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
                        <label for="Phone" class="col-sm-3 col-form-label text-right">Teléfono</label>
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
                        <label for="LiveIn" class="col-sm-3 col-form-label text-right">Lugar de residencia</label>
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
                            <option value="Coahuila" {{ $seller->LiveIn == "Coahuila" ? "selected" : '' }}>
                              Coahuila
                            </option>
                            <option value="Colima" {{ $seller->LiveIn == "Colima" ? "selected" : '' }}>
                              Colima
                            </option>
                            <option value="Durango" {{ $seller->LiveIn == "Durango" ? "selected" : '' }}>
                              Durango
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
                        <label class="col-sm-3 col-form-label text-right">Documento de identificación</label>

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

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-right">Evaluaciones</label>
                        <label class="col-sm-9 col-form-label text-left">{{ $seller->TotalEvaluations > 0 ? $seller->TotalEvaluations." evaluaciones." : "No cuenta con evaluaciones." }}</label>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-right">Ventas</label>
                        <label class="col-sm-9 col-form-label text-left">{{ $seller->ItemsSold > 0 ? $seller->ItemsSold." ventas." : "No cuenta con ventas." }}</label>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-right">Prendas</label>
                        <label class="col-sm-9 col-form-label text-left">{{ $items > 0 ? ($items == 1 ? $items." prenda subida." : $items." prendas subidas." ) : "No cuenta con prendas subidas." }}</label>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-right">Devoluciones</label>
                        <label class="col-sm-9 col-form-label text-left">{{ $seller->ItemsReturned > 0 ? $seller->ItemsReturned." devoluciones." : "No cuenta con devoluciones." }}</label>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-right">Ranking</label>
                        <div class="col-sm-9 col-form-label text-left">
                          <i class="fas fa-star yellow"></i>
                          <i class="fas fa-star yellow"></i>
                          <i class="fas fa-star yellow"></i>
                          <i class="far fa-star gray"></i>
                          <i class="far fa-star gray"></i>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label text-right">Vendedor desde</label>
                        <label class="col-sm-9 col-form-label text-left">{{ $sellerSince }}</label>
                      </div>

                      <div class="w-auto float-right">
                        <button class="btn btn-fr">Guardar</button>
                      </div>
                      
                    </form>

                  </div>
                </div>
            @endif
          </div>
          
        </div>
      </div>
    </main>
@endsection