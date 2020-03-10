@extends('dashboard.master')

@section('content')

  <main id="main">
    <div class="container py-5">
      <h2 class="text-center TituloFR my-4 mb-5 "> Dirección de envío </h2>

      <p class="mb-5 text-center w-100">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit qui ad, commodi nostrum repudiandae ipsam soluta excepturi.</p>

      <div class="w-100">
        @include('alerts.success')
        @include('alerts.warning')
      </div>

      <div class="row">

        <div class="col-md-8 offset-md-2">

          <form method="POST" id="app" action="{{ url('shipping',$isNew ? '' : $address->ShippingAddID)  }}" class="needs-validation" novalidate>
            {!! csrf_field() !!}

            <input type="hidden" value="{{ $type_url }}" name="type_url">

            <address-form
              :states="{{ json_encode($states) }}"
              :errors="{{ count($errors) > 0 ? $errors : '{}'  }}"
              :old="{{ count(Session::getOldInput()) > 0 ? json_encode(Session::getOldInput()) : '{}'}}"
            >
            </address-form>

            <div class="w-auto text-center">
              <button class="btn btn-fr w-50">
                <span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
                Guardar
              </button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </main>

@endsection