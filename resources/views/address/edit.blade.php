@extends('dashboard.master')

@section('content')

  <main id="main">
    <div class="container py-5">
      <h2 class="text-center TituloFR my-4 mb-5 ">{{ $title }}</h2>

      <p class="mb-5 text-center w-100">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit qui ad, commodi nostrum repudiandae ipsam soluta excepturi.</p>

      <div class="w-100">
        @include('alerts.success')
        @include('alerts.warning')
      </div>

      <div class="row">
        <h5 class="mb-4 text-center w-100"> 
          Modificar dirección de envío:
        </h5>

        <div class="col-md-8 offset-md-2">

          <form method="POST" action="{{ url('shipping',$isNew ? '' : $address->ShippingAddID)  }}" class="needs-validation" novalidate>
            @csrf

            <input type="hidden" value="{{ $type_url }}" name="type_url">

            @include('address.form')

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