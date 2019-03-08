@extends('layout.master')

@section('content')

    <main id="main" style="height:85vh;">
      <div class="container py-5">
        <div class="row">
          <div class="col">
            <h2 class="text-center">Crear Cuenta</h2>

            <form method="POST" action="{{ url('register') }}" class="was-validated">
              @csrf

              @include('alerts.success')
              @include('alerts.warning')

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Nombre(s)</label>
                  <input type="text" class="form-control is-invalid" name="name" id="name" placeholder="Nombre(s)">

                  @if ($errors->has('name'))
                    <div class="invalid-feedback">
                      {{ $errors->first('name') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-md-6">
                  <label for="last_name">Apellidos</label>
                  <input type="text" class="form-control is-invalid" name="last_name" id="last_name" placeholder="Apellidos">

                  @if ($errors->has('last_name'))
                    <div class="invalid-feedback">
                      {{ $errors->first('last_name') }}
                    </div>
                  @endif
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="email">Correo electrónico</label>
                  <input type="email" class="form-control is-invalid" name="email" id="email" placeholder="Correo electrónico">

                  @if ($errors->has('email'))
                    <div class="invalid-feedback">
                      {{ $errors->first('email') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-md-6">
                  <label for="password">Contraseña</label>
                  <input type="password" class="form-control is-invalid" name="password" id="password" placeholder="Contraseña">

                  @if ($errors->has('password'))
                    <div class="invalid-feedback">
                      {{ $errors->first('password') }}
                    </div>
                  @endif
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="alias">Alias</label>
                  <input type="text" class="form-control is-invalid" name="alias" id="inputCity" placeholder="Alias">

                  @if ($errors->has('alias'))
                    <div class="invalid-feedback">
                      {{ $errors->first('alias') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-md-4">
                  <label for="gender">Género</label>
                  <select id="gender" class="form-control is-invalid" name="gender">
                    <option value="" selected>- Seleccionar -</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Indefinido">Indefinido</option>
                  </select>

                  @if ($errors->has('gender'))
                    <div class="invalid-feedback">
                      {{ $errors->first('gender') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-md-2">
                  <label for="birth_date">Fecha de nacimiento</label>
                  <input type="date" class="form-control is-invalid" id="birth_date" name="birth_date">

                  @if ($errors->has('birth_date'))
                    <div class="invalid-feedback">
                      {{ $errors->first('birth_date') }}
                    </div>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input is-invalid" type="checkbox" id="notifications" name="notifications" value="true" checked="true">
                  <label class="form-check-label" for="notifications">
                    Deseo recibir notificaciones
                  </label>
                </div>
              </div>
              <button type="submit" class="btn btn-fr btn-block">Crear Cuenta</button>
            </form>
          </div>
        </div>
      </div>
    </main>

@endsection