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

			<a href="{{ url('add-address') }}" class="btn btn-fr mb-4 float-md-right">Nueva dirección</a>

			<div class="row d-flex justify-content-start align-items-stretch">

				@foreach($addresses as $address)
					<div class="card mb-4 mr-md-4" style="width: 18rem;">
					  <div class="card-body">
					    <h5 class="card-title">{{ $address->Alias }} </h5>

					    <p class="card-text">{{ $address->Street }} {{ $address->Suburb }} {{ $address->City }} {{ $address->ZipCode }}</p>

					    <a href="{{ url('payment/'.$address->ShippingAddID) }}" class="btn btn-fr w-100 mb-2">Elegir y continuar</a>
					    <a href="{{ url('address',$address->ShippingAddID) }}" class="btn btn-outline-secondary mb-2 w-100">Editar</a>
					    <a href="{{ url('shipping/'.$address->ShippingAddID.'/delete') }}" class="btn btn-outline-secondary w-100">Eliminar</a>
					  </div>
					</div>

				@endforeach

			</div>
      	</div>
    </main>

@endsection
