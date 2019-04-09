@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <h2 class="text-center mb-5">Actualizar prenda</h2>

            <form method="POST" action="{{ route('item.update',$item->ItemID) }}" class="was-validated" enctype="multipart/form-data">
              @include('item.form')
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection
