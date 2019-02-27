@extends('layout.master')

@section('content')

<!-- MAIN  -->
    <main id="main" style="height:85vh;">
      <div class="container py-5">
        <div class="row">
          <div class="col">
            <h2 class="text-center">Crear Cuenta</h2>
            <form>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Correo electónico</label>
                  <input type="email" class="form-control" id="inputEmail4" placeholder="correo electrónico">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputPassword4">Contraseña</label>
                  <input type="password" class="form-control" id="inputPassword4" placeholder="contraseña">
                </div>
              </div>
              <div class="form-group">
                <label for="inputAddress">Calle y número</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="calle y número incluyendo número interior">
              </div>
              <div class="form-group">
                <label for="inputAddress2">Colonia</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputCity">Ciudad</label>
                  <input type="text" class="form-control" id="inputCity">
                </div>
                <div class="form-group col-md-4">
                  <label for="inputState">Estado</label>
                  <select id="inputState" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <label for="inputZip">Código Postal</label>
                  <input type="text" class="form-control" id="inputZip">
                </div>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="gridCheck">
                  <label class="form-check-label" for="gridCheck">
                    Deseo Recibir Notificaciones
                  </label>
                </div>
              </div>
              <button type="submit" class="btn btn-fr btn-block">Crear Cuenta</button>
            </form>
          </div>
        </div>
      </div>
    </main>
    <!-- MAIN ENDS -->

@endsection