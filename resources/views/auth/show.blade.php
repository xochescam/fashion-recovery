@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">

          <div class="w-100">
            <h2 class="text-center TituloFR my-4 mb-5">Mi cuenta</h2>

            @include('alerts.success')
            @include('alerts.warning')
          </div>

          <div class="col-md-3 text-center">

            @if(Auth::User()->ProfileID == 2)

              <form method="POST" action="{{ url('update-selfie',Auth::User()->id) }}" class="mb-5" enctype="multipart/form-data">
                @csrf

                <label for="profile_item_file" class="mb-2">
                  <div class="card card--selfie ">
                    <img src=" {{ url($seller->SelfieThumbPath) }} " class="card-img-top js-selfie-img" alt="">
                    <i class="far fa-edit" id="edit_icon"></i>
                  </div>
                  <input type="file" class="selfieInput no-file js-selfie-input" id="profile_item_file" name="profile_item_file">
                </label>
                
                <div class="text-center">
                  <button class="btn btn-fr hidden js-selfie-btn">
                    <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                    Actualizar
                  </button>
                </div>
              </form>

            @endif

            <ul class="list-group list-group-flush">
              <a href="#" class="list-group-item list-group-item-action text-left">
                Mis datos
              </a>
              <a href="#" class="list-group-item list-group-item-action text-left">
                Mis preferencias
              </a>
              <a href="#" class="list-group-item list-group-item-action text-left">
                Wish Lists
              </a>
              <a href="#" class="list-group-item list-group-item-action text-left">
                Mis pedidos
              </a>
              <a href="#" class="list-group-item list-group-item-action text-left">
                Mis tickets
              </a>
            </ul>
          </div>

          <div class="col-md-9 ">
            @include('auth.partials.personal-data')

            @include('auth.partials.shipping-data')

            @include('auth.partials.billing-info')


            @if(Auth::User()->ProfileID == 2)
              @include('auth.partials.seller-data')
            @endif
          </div>
          
        </div>
      </div>
    </main>
@endsection