@extends('layout.master')

@section('content')

    <main id="main" style="height:85vh;">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <h2 class="text-center">Modificar datos</h2>

            <form method="POST" action="{{ url('auth',Auth::User()->id) }}" class="was-validated">
              @csrf

              @include('alerts.success')
              @include('alerts.warning')

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Nombre(s)</label>
                  <input type="text" class="form-control is-invalid" name="name" id="name" placeholder="Nombre(s)"
                  value="{{ Auth::User()->Name }}">

                  @if ($errors->has('name'))
                    <div class="invalid-feedback">
                      {{ $errors->first('name') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-md-6">
                  <label for="last_name">Apellidos</label>
                  <input type="text" class="form-control is-invalid" name="last_name" id="last_name" placeholder="Apellidos" value="{{ Auth::User()->Lastname }}">

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
                  <input type="email" class="form-control is-invalid" name="email" id="email" placeholder="Correo electrónico" value="{{ Auth::User()->email }}">

                  @if ($errors->has('email'))
                    <div class="invalid-feedback">
                      {{ $errors->first('email') }}
                    </div>
                  @endif
                </div>

                <div class="form-group col-md-6">
                  <label for="alias">Alias</label>
                  <input type="text" class="form-control is-invalid" name="alias" id="inputCity" placeholder="Alias"
                  value="{{ Auth::User()->Alias }}">

                  @if ($errors->has('alias'))
                    <div class="invalid-feedback">
                      {{ $errors->first('alias') }}
                    </div>
                  @endif
                </div>
              </div>

              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input is-invalid" type="checkbox" id="notifications" name="notifications" value="true" {{ Auth::User()->Notifications ? "checked='true'" : '' }}">
                  <label class="form-check-label" for="notifications">
                    Deseo recibir notificaciones
                  </label>
                </div>
              </div>

              <button type="submit" class="btn btn-fr btn-block">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </main>

@endsection