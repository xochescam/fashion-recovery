@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <h2 class="text-center">Modificar datos</h2>

            <form method="POST" action="{{ url('seller',$seller->SellerID) }}" class="was-validated" enctype="multipart/form-data">
              @include('seller.form')
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection
