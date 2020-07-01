
  <div class="m-auto">
    
    <div class="row">

    <form method="POST" action="{{ url('seller',$seller->UserID) }}" class="needs-validation col-md-6" enctype="multipart/form-data" novalidate>

      {!! csrf_field() !!}

        <edit-seller
          :seller="{{ json_encode($seller) }}"
          :states="{{ json_encode($states) }}"
          :errors="{{ count($errors) > 0 ? $errors : '{}'  }}"
          :old="{{ count(Session::getOldInput()) > 0 ? json_encode(Session::getOldInput()) : '{}'}}"
        ></edit-seller>

      </form>
      

          <hr class="my-5 w-100 d-block d-md-none">

          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Evaluaciones</label>
              <label class="col-sm-9 col-form-label text-left">{{ isset($evaluations) &&  $evaluations > 0 ? $evaluations." evaluaci".($evaluations > 1 ? 'ones.' : 'ón.') : "No cuenta con evaluaciones." }}</label>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Ventas</label>
              <label class="col-sm-9 col-form-label text-left">{{ isset($finalized) && count($finalized) > 0 ? count($finalized)." venta".(count($finalized) > 1 ? 's.' : '.') : "No cuenta con ventas." }}</label>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Prendas</label>
              <label class="col-sm-9 col-form-label text-left">{{ isset($items) && $items > 0 ? ($items == 1 ? $items." prenda subida." : $items." prendas subidas." ) : "No cuenta con prendas subidas." }}</label>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Devoluciones</label>
              <label class="col-sm-9 col-form-label text-left">{{ isset($seller->ItemsReturned) && $seller->ItemsReturned > 0 ? $seller->ItemsReturned." devoluciones." : "No cuenta con devoluciones." }}</label>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Ranking</label>
              <div class="col-sm-9 col-form-label text-left">

                @if(isset($ranking))
                  @foreach($ranking as $rank)
                    @if($rank === 1) 
                      <i class="fas fa-star yellow"></i>
                    @else
                      <i class="far fa-star gray"></i>
                    @endif
                  @endforeach
                @endif

              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Mi cartera</label>
              <label class="col-sm-9 col-form-label text-left"> $0 </label>

            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Vendedor desde</label>
              <label class="col-sm-9 col-form-label text-left">{{ $sellerSince }}</label>
            </div>
          </div>
      </div>

      </div>
  </div>
