<section id="offersDeLaSemana" class="mt-5">
  <div class="container-fluid">
    <div class="row">
      <div class="col text-center text-uppercase mb-4">
        <small>Conoce las</small>
        <h2>Ofertas de la semana</h2>
      </div>
    </div>
    <div class="row justify-content-start shadow-lg p-3 mb-5 bg-white rounded mx-md-5">

      @foreach($items as $item)

        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 mt-4">
          <a href="{{ url('items/'.$item->ItemID.'/public') }}" class="link-card">
            <div class="card card--public card--item shadow p-3 bg-white rounded d-flex align-items-stretch h-100">
              <img class="card-img-top" src="{{ url('storage',$item->ThumbPath) }}" alt="Card image cap" height="200px;">
              <div class="card-body px-0 p-lg-3">
                
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
                        ${{ $item->ActualPrice }} 
                      </span>
                    </div>
                  @endif

                <div class="container-fade">
                  <p>{{ $item->ItemDescription }}</p>
                </div>
                <p class="card-text" style="border-bottom: 1px solid gray; border-top: 1px solid gray;">
                  Talla: {{ isset($item->otherBrand->OtherSize) ? $item->otherBrand->OtherSize : $item->size }} <br />Color: {{ $item->ColorName }}</p>
              </div>
            </div>
          </a>
        </div>

      @endforeach

    </div>
  </div>
</section>
