@foreach($items as $item)

    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 mt-4">
        <a href="{{ url('item',$item->ItemID) }}" class="link-card">

        <div class="card card--public card--item shadow mb-5 bg-white rounded d-flex w-100 align-items-stretch">
            <img class="card-img-top" src="{{ url('storage',$item->ThumbPath) }}" alt="Card image cap" height="200px;">
            <div class="card-body">
                <h4 class="card-title mb-0">{{ isset($item->otherBrand->OtherBrand) ? $item->otherBrand->OtherBrand : $item->brand   }}</h4> 

                <div class="float-right">
                    <span class="mr-2 text-black-50">
                      <del>{{ $item->OriginalPrice }} </del>
                    </span>

                    <p class="badge alert-success badge-price">
                      {{ $item->ActualPrice }} 
                    </p>
                </div>

                <div class="float-right w-100">
                    <div class="form-group m-0 row float-right">
                        <label class="col-form-label my-auto mr-2">Pausar prenda</label>
                        <div class="col-form-label text-left d-flex align-top">
                          <guardarropa-component
                            initial="{{ $item->IsPaused }}"
                            type="item"
                            item="{{ $item->ItemID }}"
                          ></guardarropa-component>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </a>
</div>  
              
@endforeach