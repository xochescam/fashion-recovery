@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <h2 class="text-center TituloFR my-4">Modificar temporada</h2>

            <form method="POST" action="{{ route('seasons.update',$season->SeasonID) }}" class="was-validated">
              @include('catalogs.season.form')
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection