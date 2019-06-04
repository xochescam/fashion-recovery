@extends('dashboard.master')

@section('content')

    <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col col-sm-12 col-md-6 offset-md-3">
            <h2 class="text-center TituloFR my-4">Cambiar contraseña</h2>

            <form method="POST" action="{{ url('update-password') }}" class="needs-validation"novalidate>
              @csrf

              @include('alerts.success')
              @include('alerts.warning')

              <div class="form-row">

                <div class="form-group col-md-12">
                  <label for="current_password">Contraseña actual</label>
                  <input type="password" name="current_password" class="form-control" id="current_password" required>

                  @if ($errors->has('current_password'))
                    <div class="invalid-feedback">
                      {{ $errors->first('current_password') }}
                    </div>
                  @else
                    <div class="invalid-feedback">
                      El campo contraseña actual es obligatorio
                    </div>
                  @endif
                </div>

                <div class="form-group col-md-12">
                  <label for="password">Nueva contraseña</label>
                  <input type="password" name="password" class="form-control" id="password" required>

                  @if ($errors->has('password'))
                    <div class="invalid-feedback">
                      {{ $errors->first('password') }}
                    </div>
                  @else
                    <div class="invalid-feedback">
                      El campo nueva contraseña es obligatorio
                    </div>
                  @endif
                </div>

                <div class="form-group col-md-12">
                  <label for="password_confirmation">Confirmar nueva contraseña</label>
                  <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>

                  @if ($errors->has('password_confirmation'))
                    <div class="invalid-feedback">
                      {{ $errors->first('password_confirmation') }}
                    </div>
                  @else
                    <div class="invalid-feedback">
                      El campo confirmar nueva contraseña es obligatorio
                    </div>
                  @endif
                </div>

              </div>
              <button type="submit" class="btn btn-fr btn-block">
                <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                Guardar
              </button>
            </form>

          </div>
        </div>
      </div>
    </main>

@endsection