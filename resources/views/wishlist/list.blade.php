@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row mb-1">
	        	<div class="col-sm-10 col-8">
                    <h2 class="left-center TituloFR my-4 mb-5">Mis wishlists</h2>
                </div>
                <div class="col-sm-2 col-4">
                    <button type="button" class="btn btn-fr float-right my-4 mb-5" data-toggle="modal" data-target="#addWishlist">
                        Crear wishlist
                    </button>
                </div>

                <p class="mb-5 text-center w-100">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia eligendi sint, officiis fugit optio ullam quod even..</p>
            </div>

            @include('alerts.success')
            @include('alerts.warning')

            <div class="row">
              
              @foreach($wishlists as $wishlist)

                <div class="col-sm-4 mb-4">
                  <a href="{{ isset($wishlist['Items']) && count($wishlist['Items']) > 0 ? route('wishlists.show',$wishlist['WishListID']) : '#' }}">
                  <div class="card card--public card--public card--item">

                    @if(count($wishlist['Items']) > 0)
                      
                        <div id="carousel_{{ $wishlist['WishListID'] }}" class="carousel mb-3">
                          <div class="carousel-inner">
                            @foreach($wishlist['Items'] as $item)
                              <div class="carousel-item {{ $item->first()->ItemPictureID == $wishlist['Items']->first()->first()->ItemPictureID ? 'active' : ''  }}">

                                <img src="{{ url('storage/'.$item->first()->ThumbPath) }}" class="d-block w-100" alt="...">
                              </div>
                            @endforeach

                          </div>
                          <a class="carousel-control-prev" href="#carousel_{{ $wishlist['WishListID'] }}" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carousel_{{ $wishlist['WishListID'] }}" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
                      
                    @else

                      <div id="carousel_{{ $wishlist['WishListID'] }}" class="carousel mb-3">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="https://via.placeholder.com/200.png?text=Imagen" class="d-block w-100" alt="...">
                          </div>
                          <div class="carousel-item">
                            <img src="https://via.placeholder.com/200.png?text=Imagen" class="d-block w-100" alt="...">
                          </div>
                          <div class="carousel-item">
                            <img src="https://via.placeholder.com/200.png?text=Imagen" class="d-block w-100" alt="...">
                          </div>
                        </div>
                        <a class="carousel-control-prev" href="#carousel_{{ $wishlist['WishListID'] }}" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel_{{ $wishlist['WishListID'] }}" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                    
                    @endif

                    
                    <div class="card-body">
                      <h5 class="card-title"> 
                        @if(!$wishlist['IsPublic'])
                          <i class="fas fa-user-lock"></i> 
                        @endif
                        
                        {{ $wishlist['NameList'] }} 
                      </h5>
                      <a href="{{ route('wishlists.edit',$wishlist['WishListID']) }}" class="card-link">Editar</a>
                      <a href="{{ route('wishlists.destroy',$wishlist['WishListID']) }}" class="card-link text-danger">Eliminar</a>
                    </div>
                  </div>
                </div>
                </a>

              @endforeach
            </div>
        </div>

        <!-- Modal -->
        @include('wishlist.create')
	</main>
@endsection
