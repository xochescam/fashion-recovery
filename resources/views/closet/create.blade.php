@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">
            <h2 class="text-center TituloFR my-4 mb-5 w-100">Crear nueva colección</h2>

            <p class="text-center mb-5 w-100">
              En esta sección crea looks y conjuntos únicos para que nuestra comunidad Fashion Recovery pueda descubrir tu clóset. Puedes crear colecciones por temporada, para un modo específico o para ajustarte a algún look.
            </p>

          <div class="col-md-6 offset-md-3">
            <form method="POST" action="{{ url('closet') }}" class="needs-validation" novalidate>
              @include('closet.form')
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection
