@extends('layout.master')

@section('content')

    <main id="main">
      <div class="container py-5 mb-5">
        <div class="row  mb-5">

          <div class="text-center w-100">
             <h2 class="text-center my-3 h6-md mb-5">Recuperar contraseña</h2>

            <small class="font-weight-light"> Te enviaremos un correo con información para que puedas cambiar tu contraseña.</small>
          </div>

          <div class="col col-sm-12 col-md-6 offset-md-3 mt-5 mb-5">

            <form method="POST" action="{{ route('password.email') }}" class="needs-validation" novalidate>
              @csrf

              @include('alerts.success')
              @include('alerts.warning')

              <div class="form-row">

                <div class="form-group col-md-12">
                  <label for="email">Correo electrónico</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Ingresa tu correo electrónico" required>

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
              <button type="submit" class="btn btn-fr btn-block">Recuperar</button>
            </form>
          </div>
        </div>

      </div>
    </main>
@endsection
