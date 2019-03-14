@extends('dashboard.master')

@section('content')

	 <main id="main" style="height:85vh;">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <h2 class="text-center">Modificar tipo de ropa</h2>

            <form method="POST" action="{{ route('clothing-types.update',$clothingType->ClothingTypeID) }}" class="was-validated">
              @include('admin.clothing-type.form')
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection