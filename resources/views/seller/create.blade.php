@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <h2 class="text-center TituloFR my-4 mb-5">Registro de vendedor</h2>

            <form method="POST" action="{{ url('seller') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
              @include('seller.form')
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection
