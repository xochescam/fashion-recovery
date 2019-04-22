@extends('layout.master')

@section('content')

    <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col col-sm-12 col-md-6 offset-md-3">
            <h2 class="text-center my-3 h6-md mb-5">Iniciar sesión</h2>

            <form method="POST" action="{{ url('login/'.$beSeller) }}" class="needs-validation" novalidate>
              @csrf

              @include('alerts.success')
              @include('alerts.warning')

              <div class="form-row">

                <div class="form-group col-md-12">
                  <label for="email">Correo electrónico</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Ingresa tu correo" required>

                  @if ($errors->has('email'))
                    <div class="invalid-validation">
                      {{ $errors->first('email') }}
                    </div>
                  @else
                    <div class="invalid-feedback">
                      Ingresa tu correo electrónico.
                    </div>
                  @endif

                </div>

                 <div class="form-group col-md-12">
                  <label for="password">Contraseña</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Ingresa tu contraseña" required>

                  @if ($errors->has('password'))
                    <div class="invalid-validation">
                      {{ $errors->first('password') }}
                    </div>
                  @else
                    <div class="invalid-feedback">
                      Ingresa tu contraseña.
                    </div>
                  @endif
                </div>

              </div>
              <button type="submit" class="btn btn-fr btn-block">Iniciar sesión</button>
            </form>

          </div>
        </div>
        <div class="row mt-4 ">
          <div class="col col-md-6 offset-md-3">
            <p class="mb-1"><a href="{{ route('password.request') }}" class="text-center">¿Olvidaste tu contraseña?</a></p>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col col-md-6 offset-md-3 mb-5">
            <p class="mb-1">¿Aún no tienes cuenta?<a href="{{ url('register',0) }}" class="text-center"> Registrate aquí</a></p>
          </div>
        </div>
      </div>
    </main>

@endsection
