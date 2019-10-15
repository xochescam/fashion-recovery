@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">
          <h2 class="text-center TituloFR my-4 mb-5 w-100">Subir prenda</h2>

          <p class="text-center mb-5 w-100">Cambio ipsum dolor sit amet, consectetur adipisicing elit. Suscipit qui ad, commodi nostrum repudiandae ipsam soluta excepturi.</p>

          <div class="col-md-8 offset-md-2">
            <form method="POST" action="{{ url('item') }}" class="needs-validation" enctype="multipart/form-data" novalidate>

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
