@extends('dashboard.master')

@section('content')

	<main id="main">
	    <div class="container pt-5">

			<h2 class="text-left TituloFR my-4 mb-5">Hola, {{ Auth::User()->Alias }}</h2>

			<div class="w-75">
				@include('alerts.success')
      			@include('alerts.warning')							
			</div>

			@if(!Auth::User()->Confirmed)

				<div class="alert alert-warning w-75" role="alert">
					Confirma tu dirección de correo electrónico 

					<a href="{{ url('resend-confirm-account',Auth::User()->id) }}" class="alert-link">reenviar enlace</a>.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					</button>
				</div>
			@endif

		</div>

		<section id="offersDeLaSemana">
		  	<div class="container-fluid">
				<div class="row justify-content-start shadow-lg p-3 mb-5 bg-white rounded mx-md-5">
					@include('item.partials.card')
				</div>
		  	</div>
		</section>
	</main>
@endsection
