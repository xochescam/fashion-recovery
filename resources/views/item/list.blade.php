@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <h2 class="text-center TituloFR my-4 mb-5 w-100">Mis prendas</h2>

        <p class="text-center mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit qui ad, commodi nostrum repudiandae ipsam soluta excepturi.</p>

        @include('alerts.success')
        @include('alerts.warning')

        <div class="text-right w-100">
          <a href="{{ url('item') }}" class="btn btn-fr mb-4">Subir prenda</a>
        </div>

          <div class="row justify-content-start p-3">
            @foreach($items as $item)

            <div class="col-lg-3 col-md-4 col-sm-6 mb-4 mt-4">
              <a href="{{ url('item',$item->ItemID) }}" class="link-card">

                <div class="card card--public card--item shadow mb-5 bg-white rounded d-flex w-100 align-items-stretch">
                  <img class="card-img-top" src="{{ url('storage',$item->ThumbPath) }}" alt="Card image cap" height="200px;">
                  <div class="card-body">
                  <h4 class="card-title mb-0">{{ isset($item->otherBrand->OtherBrand) ? $item->otherBrand->OtherBrand : $item->brand   }}</h4> 

                    @if(isset($item->offer))
                      <div class="badges float-right mb-2">
                        <span class="badge badge-pill badge-danger">{{ $item->offer }}</span>
                        <span class="badge badge-pill badge-success">
                          ${{ $item->PriceOffer }}
                        </span>
                      </div>
                    @else
                      <div class="badges float-right mb-2">
                        <span class="badge badge-pill badge-success">
                          {{ $item->ActualPrice }} 
                        </span>
                      </div>
                    @endif

                  </div>
                </div>
                </a>
              </div>  
              
            @endforeach

          </div>
        </div>
    </main>

@endsection
