@extends('dashboard.master')

@section('content')

   <main id="main">
      <div class="container py-5">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <h2 class="text-center TituloFR my-4 mb-5 ">Modificar wishlist</h2>

            <form method="POST" action="{{ route('wishlists.update',$Wishlist->WishListID) }}" class="needs-validation" novalidate>
              @include('wishlist.form')
            </form>
          </div>
        </div>
      </div>
    </main>
@endsection
