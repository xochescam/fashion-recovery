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
            @include('item.partials.card-auth')
          </div>
        </div>
    </main>

@endsection
