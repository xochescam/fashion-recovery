@extends('layout.master')

@section('content')

    <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col col-sm-12 col-md-6 offset-md-3">
            <h2 class="text-center TituloFR my-4">Recuperar contraseña</h2>

            <form method="POST" action="{{ route('password.email') }}" class="was-validated">
              @csrf

              @include('alerts.success')
              @include('alerts.warning')

              <div class="form-row">

                <div class="form-group col-md-12">
                  <label for="email">Correo electrónico</label>
                  <input type="text" name="email" class="form-control is-invalid" id="email" placeholder="Ingresa tu correo">

                  @if ($errors->has('email'))
                    <div class="invalid-feedback">
                      {{ $errors->first('email') }}
                    </div>
                  @endif
                </div>

              </div>
              <button type="submit" class="btn btn-fr btn-block">Recuperar</button>
            </form>
          </div>
        </div>

      </div>
    </main>
@endsection
