@extends('layout.master')

@section('content')

    <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col col-sm-12 col-md-6 offset-md-3">
            <h2 class="text-center my-3 h6-md">Iniciar Sesión</h2>

            <form method="POST" action="{{ url('login') }}" class="was-validated">
              @csrf

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

                 <div class="form-group col-md-12">
                  <label for="password">Contraseña</label>
                  <input type="password" name="password" class="form-control is-invalid" id="password" placeholder="Ingresa tu contraseña">

                  @if ($errors->has('password'))
                    <div class="invalid-feedback">
                      {{ $errors->first('password') }}
                    </div>
                  @endif
                </div>

              </div>
              <button type="submit" class="btn btn-fr btn-block">Iniciar Sesión</button>
            </form>

          </div>
        </div>
        <div class="row text-center my-5">
          <div class="col ">
            <p><a href="{{ route('password.request') }}" class="text-center">¿Olvidaste tu contraseña?</a></p>
          </div>
          <div class="col ">
            <p>¿Aún no tienes cuenta?<a href="{{ url('register') }}" class="text-center"> Registrate aquí</a></p>
          </div>
        </div>
      </div>
    </main>

@endsection