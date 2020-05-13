@extends('layout.master')

@section('content')

    <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col col-sm-12 col-md-6 offset-md-3">
            <h2 class="text-center TituloFR my-4 mb-5">Cambiar contraseña</h2>

            <form method="POST" action="{{ route('password.update') }}" class="needs-validation" novalidate>
              @csrf

              <input type="hidden" name="token" value="{{ $token }}">

              @include('alerts.success')
              @include('alerts.warning')

              <div class="form-row">

                <div class="form-group col-md-12">
                  <label for="email">Correo electrónico</label>
                  <input type="text" name="email" class="form-control" id="email" placeholder="Ingresa tu correo">

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

                <div class="form-group col-md-12">
                  <label for="password">Contraseña</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Escribe tu nueva contraseña">

                  @if ($errors->has('password'))
                    <div class="invalid-validation">
                      {{ $errors->first('password') }}
                    </div>
                  @else
                    <div class="invalid-feedback">
                      Ingresa una contraseña válida.
                    </div>
                  @endif
                </div>

                <div class="form-group col-md-12">
                  <label for="password_confirmation">Confirmar contraseña</label>
                  <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Vuelve a escribir tu nueva contraseña">

                  @if ($errors->has('password_confirmation'))
                    <div class="invalid-validation">
                      {{ $errors->first('password_confirmation') }}
                    </div>
                  @else
                    <div class="invalid-feedback">
                      Confirma la nueva contraseña.
                    </div>
                  @endif
                </div>

              </div>
              <button type="submit" class="btn btn-fr btn-block">
                <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                Cambiar
              </button>
            </form>
          </div>
        </div>

      </div>
    </main>
@endsection
