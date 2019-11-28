@foreach($items as $item)
  <div class="col-lg-3 col-md-4 col-sm-6 mb-4 mt-4 item-option">

    @if(Auth::User())

        <heart-wishlist-component
          initial="{{ isset( Auth::User()->inWishlist($item->ItemID)->WishlistID ) > 0 ? true : false }}"
          wish="{{ isset( Auth::User()->inWishlist($item->ItemID)->WishlistID ) > 0 ? Auth::User()->inWishlist($item->ItemID)->WishlistID : 0 }}"
          wishlists="{{ count(Auth::User()->getWishlists()) > 0 ? Auth::User()->getWishlists() : null }}"
          item="{{ $item->ItemID }}"
        ></heart-wishlist-component>

     @else
     
      <a href="{{ url('login/0') }}"><i class="far fa-heart heart-wishlist"></i></a>

		 @endif

    <a href="{{ url('items/'.$item->ItemID.'/public') }}" class="link-card">
      <div class="card card--public card--item shadow p-3 bg-white rounded d-flex align-items-stretch h-100">
        
        <!-- <i class="fas fa-heart"></i> -->
          <img class="card-img-top" src="{{ url('storage',$item->ThumbPath) }}" alt="Card image cap" height="200px;">
          <div class="card-body px-0 p-lg-3">
              
            <h4 class="card-title mb-0">{{ isset($item->otherBrand->OtherBrand) ? $item->otherBrand->OtherBrand : $item->brand   }}</h4>

            <div class="float-right">
              <span class="mr-2 text-black-50">
                <del>{{ $item->OriginalPrice }} </del>
              </span>

              <p class="badge alert-success badge-price">
                {{ $item->ActualPrice }} 
              </p>
            </div>
                  
            <div class="container-fade">
              <p>{{ $item->ItemDescription }}</p>
            </div>
          <p class="card-text" style="border-bottom: 1px solid gray; border-top: 1px solid gray;">
            Talla: {{ isset($item->otherBrand->OtherSize) ? $item->otherBrand->OtherSize : $item->size }} <br />Color: {{ $item->ColorName }}</p>
        </div>
      </div>
    </a>
  </div>

  <!-- Modal -->
  @include('wishlist.create')

@endforeach




