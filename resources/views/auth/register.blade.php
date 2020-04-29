@extends('layout.master')

@section('content')

    <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-10 m-auto">
            <h2 class="text-center mb-5">Crear cuenta</h2>

            <form method="POST" action="{{ url('register/'.$beSeller) }}" class="needs-validation mb-4" novalidate>
              @csrf

              @include('alerts.success')
              @include('alerts.warning')

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Nombre(s)</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Nombre(s)" value="{{ old('name') }}">

                  @if ($errors->has('name'))
                    <div class="invalid-feedback">
                      {{ $errors->first('name') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-md-6">
                  <label for="last_name">Apellidos</label>
                  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Apellidos" value="{{ old('last_name') }}">

                  @if ($errors->has('last_name'))
                    <div class="invalid-feedback">
                      {{ $errors->first('last_name') }}
                    </div>
                  @endif
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="alias">Alias *</label>
                  <input type="text" class="form-control" name="alias" id="inputCity" placeholder="Alias" value="{{ old('alias') }}" required>

                  @if ($errors->has('alias'))
                    <div class="invalid-validation">
                      {{ $errors->first('alias') }}
                    </div>
                  @else
                    <div class="invalid-feedback">
                      El campo alias es requerido.
                    </div>
                  @endif

                </div>
                <div class="form-group col-md-6">
                  <label for="email">Correo electrónico *</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>

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

                <div class="form-group col-md-6">
                  <label for="password">Contraseña *</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>

                  @if ($errors->has('password'))
                    <div class="invalid-validation">
                      {{ $errors->first('password') }}
                    </div>
                  @else
                    <div class="invalid-feedback">
                      El campo contraseña es requerido.
                    </div>
                  @endif
                </div>

                <div class="form-group col-md-6">
                  <label for="password_confirmation">Repite tu contraseña *</label>
                  <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Repetir contraseña" required>

                  <div class="invalid-feedback">
                    El campo recuperar contraseña es requerido.
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="gender">Género</label>
                  <select id="gender" class="form-control" name="gender">
                    <option value="" selected>- Seleccionar -</option>
                    <option value="Masculino" {{ old('gender') == 'Masculino' ? 'selected' : ''}}>Masculino</option>
                    <option value="Femenino" {{ old('gender') == 'Femenino' ? 'selected' : ''}}>Femenino</option>
                    <option value="Indefinido" {{ old('gender') == 'Indefinido' ? 'selected' : ''}}>Indefinido</option>
                  </select>

                  @if ($errors->has('gender'))
                    <div class="invalid-feedback">
                      {{ $errors->first('gender') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-md-6">
                <label for="birth_date">Fecha de nacimiento {{ old('birth_date')[0] }}</label>

                @include('auth.partials.birthdate')

                </div>
              </div>

              <div class="form-group">

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="notifications" name="notifications"  value="true" {{ old('notifications') !== null ? (old('notifications') == true ? 'checked' : '' ) : 'checked' }}>
                  <label class="form-check-label" for="notifications">
                    Suscribirme al newsletter y notifícame de ofertas especiales.
                  </label>
                </div>

                <div class="form-check mt-2">
                  <input class="form-check-input" type="checkbox" id="terms" name="terms"  value="true" required>
                  <label class="form-check-label" for="terms">
                    He leído y acepto los <a href="{{ url('terms') }}" target="_blank">Términos y condiciones</a> y <a href="{{ url('privacy') }}" target="_blank">Aviso de privacidad</a>
                  </label>

                  @if ($errors->has('terms'))
                    <div class="invalid-validation">
                      {{ $errors->first('terms') }}
                    </div>
                  @else
                    <div class="invalid-feedback">
                      El campo es requerido.
                    </div>
                  @endif
                </div>

              </div>
              <div class="text-center mt-5">
                <button type="submit" class="btn btn-fr w-50">
                  <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                  Crear cuenta
                </button>
              </div>
              <div class="row mb-5">
                <div class="col col-md-6 offset-md-3 mb-5 mt-4">
                  <p class="mb-1 text-center">¿Ya tienes una cuenta? 
                    <a href="{{ url('login',$beSeller) }}" class="text-center">Inicia sesión</a></p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>

@endsection
