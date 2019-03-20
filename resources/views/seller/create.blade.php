@extends('dashboard.master')

@section('content')

	 <main id="main" style="height:85vh;">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <h2 class="text-center">Registro de vendedor</h2>

            <form method="POST" action="{{ url('register/seller') }}" class="was-validated" enctype="multipart/form-data">
              @include('seller.form')
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection
