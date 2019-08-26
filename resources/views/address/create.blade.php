@extends('dashboard.master')

@section('content')

  <main id="main">
    <div class="container py-5">
      <h2 class="text-center TituloFR my-4 mb-5 ">Selecciona una dirección de envío</h2>

      <p class="mb-5 text-center w-100">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit qui ad, commodi nostrum repudiandae ipsam soluta excepturi.</p>

      <div class="w-100">
        @include('alerts.success')
        @include('alerts.warning')
      </div>

      <div class="row">
        <h5 class="mb-4 text-center w-100"> 
          Introduce una nueva dirección de envío:
        </h5>

        <div class="col-md-6 offset-md-3">
          @include('address.form')
        </div>

      </div>
    </div>
  </main>

@endsection