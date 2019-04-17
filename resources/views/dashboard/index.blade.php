@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">

					@if(Auth::User()->isSellerProfile())

					    <h2 class="left-center TituloFR my-4 mb-5 ">Hola {{ Auth::User()->Alias }}, este es tu Guardarropa.</h2>

					    <p class="mb-5">Conviertete socialmente responsable cuidando al planeta a través de las prendas verdes. </p>

						<div class="row">
						  <div class="col-sm-6">
						    <div class="card card--public card--item">
                                <img class="card-img-top" src="{{ url('img/cards/closets.jpg') }}" alt="closets-img" />
						        <div class="card-body">
    						        <h5 class="card-title">Guardarropas</h5>
						            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
						            <a href="{{ url('closets') }}" class="btn btn-fr">Ver</a>
						        </div>
						    </div>
						  </div>
						  <div class="col-sm-6">
						    <div class="card card--public card--item">
                                <img class="card-img-top" src="{{ url('img/cards/prendas.jpg') }}" alt="prendas-img" />
                                <div class="card-body">
                                    <h5 class="card-title">Prendas</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    <a href="{{ url('items') }}" class="btn btn-fr">Ver</a>
                                </div>
						    </div>
						  </div>
						</div>

					@else

						<h2 class="text-center TituloFR my-4 mb-5">Hola, {{ isset(Auth::User()->Name) ? Auth::User()->Name : Auth::User()->Alias }}</h2>

						<div class="w-75">
							@include('alerts.success')
              				@include('alerts.warning')							
						</div>


						@if(!Auth::User()->Confirmed)

							<div class="alert alert-warning w-75" role="alert">
							  Confirma tu dirección de correo electrónico <a href="{{ url('resend-confirm-account',Auth::User()->id) }}" class="alert-link">reenviar enlace</a>.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    	<span aria-hidden="true">&times;</span>
								</button>
							</div>
						@endif

					@endif

				</div>
			</div>
		</div>
	</main>
@endsection
