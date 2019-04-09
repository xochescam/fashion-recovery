@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <h2 class="text-center TituloFR my-4">Modificar categoría</h2>

            <form method="POST" action="{{ route('categories.update',$category->CategoryID) }}" class="was-validated">
              @include('catalogs.category.form')
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection