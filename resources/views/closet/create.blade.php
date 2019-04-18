@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">
            <h2 class="text-center TituloFR my-4 mb-5 w-100">Crear nueva colección</h2>

            <p class="text-center mb-5 w-100">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit qui ad, commodi nostrum repudiandae ipsam soluta excepturi.</p>

          <div class="col-md-6 offset-md-3">
            <form method="POST" action="{{ url('closet') }}" class="needs-validation" novalidate>
              @include('closet.form')
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection
