@extends('dashboard.master')

@section('content')

	 <main id="main" style="height:85vh;">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <h2 class="text-center">Modificar temporada</h2>

            <form method="POST" action="{{ route('seasons.update',$season->SeasonID) }}" class="was-validated">
              @include('admin.season.form')
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection