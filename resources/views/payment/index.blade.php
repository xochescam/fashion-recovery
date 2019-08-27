@extends('dashboard.master')

@section('content')

	<main id="main">
      	<div class="container py-5">
        	<h2 class="text-center TituloFR my-4 mb-5 ">Método de pago</h2>

        	<p class="mb-5 text-center w-100">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit qui ad, commodi nostrum repudiandae ipsam soluta excepturi.</p>

			<div class="w-100">
				@include('alerts.success')
				@include('alerts.warning')
			</div>

			<div class="row">
				<a href="{{ url('summary',$address->ShippingAddID) }}" class="btn btn-fr m-auto">Continuar</a>
			</div>
      </div>
    </main>

@endsection
