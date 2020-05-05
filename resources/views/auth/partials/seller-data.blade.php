
  <div class="m-auto">
    
    <div class="row">

    <form method="POST" action="{{ url('seller',$seller->UserID) }}" class="needs-validation col-md-6" enctype="multipart/form-data" novalidate>

      {!! csrf_field() !!}
      @include('alerts.success')
      @include('alerts.warning')

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
              <label class="col-sm-9 col-form-label text-left">{{ $seller->TotalEvaluations > 0 ? $seller->TotalEvaluations." evaluaciones." : "No cuenta con evaluaciones." }}</label>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Ventas</label>
              <label class="col-sm-9 col-form-label text-left">{{ $seller->ItemsSold > 0 ? $seller->ItemsSold." ventas." : "No cuenta con ventas." }}</label>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Prendas</label>
              <label class="col-sm-9 col-form-label text-left">{{ $items > 0 ? ($items == 1 ? $items." prenda subida." : $items." prendas subidas." ) : "No cuenta con prendas subidas." }}</label>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Devoluciones</label>
              <label class="col-sm-9 col-form-label text-left">{{ $seller->ItemsReturned > 0 ? $seller->ItemsReturned." devoluciones." : "No cuenta con devoluciones." }}</label>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Ranking</label>
              <div class="col-sm-9 col-form-label text-left">
                <i class="fas fa-star yellow"></i>
                <i class="fas fa-star yellow"></i>
                <i class="fas fa-star yellow"></i>
                <i class="far fa-star gray"></i>
                <i class="far fa-star gray"></i>
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
