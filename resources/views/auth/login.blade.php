@extends('layout.master')

@section('content')

    <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col col-sm-12 col-md-6 offset-md-3">
            <h2 class="text-center my-3 h6-md">Iniciar Sesión</h2>
            <form>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputEmail4">Correo electónico</label>
                  <input type="email" class="form-control" id="inputEmail4" placeholder="Ingresa tu correo">
                </div>
                <div class="form-group col-md-12">
                  <label for="inputPassword4">Contraseña</label>
                  <input type="password" class="form-control" id="inputPassword4" placeholder="Ingresa tu contraseña">
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