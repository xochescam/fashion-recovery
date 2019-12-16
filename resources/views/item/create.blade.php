@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">
          <h2 class="text-center TituloFR my-4 mb-5 w-100">Subir prenda</h2>

          <p class="text-center mb-5 w-100">¡Comparte tus mejores prendas con nuestra comunidad y cuida de nuestro planeta mientras ganas dinero!</p>

          <div class="col-md-8 offset-md-2">
            <form method="POST" action="{{ url('item') }}" class="needs-validation" enctype="multipart/form-data" novalidate>

              <p><small>Todos los campos con * son obligatorios.</small></p>

              <div id="app">
              @include('item.form')
              </div>

              <div class="text-center mt-5">
                <button type="submit" class="btn btn-fr w-50">
                  <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                  Subir
               </button>

               
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection
