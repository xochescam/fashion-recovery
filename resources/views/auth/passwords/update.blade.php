@extends('dashboard.master')

@section('content')

    <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col col-sm-12 col-md-6 offset-md-3">
            <h2 class="text-center my-3 h6-md">Cambiar contraseña</h2>

            <form method="POST" action="{{ url('update-password') }}" class="was-validated">
              @csrf

              @include('alerts.success')
              @include('alerts.warning')

              <div class="form-row">

                <div class="form-group col-md-12">
                  <label for="current_password">Contraseña actual</label>
                  <input type="password" name="current_password" class="form-control is-invalid" id="current_password">

                  @if ($errors->has('current_password'))
                    <div class="invalid-feedback">
                      {{ $errors->first('current_password') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-md-12">
                  <label for="password">Nueva contraseña</label>
                  <input type="password" name="password" class="form-control is-invalid" id="password">

                  @if ($errors->has('password'))
                    <div class="invalid-feedback">
                      {{ $errors->first('password') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-md-12">
                  <label for="password_confirmation">Confirmar nueva contraseña</label>
                  <input type="password" name="password_confirmation" class="form-control is-invalid" id="password_confirmation">

                  @if ($errors->has('password_confirmation'))
                    <div class="invalid-feedback">
                      {{ $errors->first('password_confirmation') }}
                    </div>
                  @endif
                </div>

              </div>
              <button type="submit" class="btn btn-fr btn-block">Guardar</button>
            </form>

          </div>
        </div>
      </div>
    </main>

@endsection