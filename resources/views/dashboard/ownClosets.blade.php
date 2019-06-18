@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
					<h2 class="left-center TituloFR my-4 mb-5 ">Hola {{ Auth::User()->Alias }}, este es tu Guardarropa.</h2>

					<p class="mb-5">Conviertete socialmente responsable cuidando al planeta a través de las prendas verdes. </p>

					<div class="row">
						<div class="col-sm-6 mb-5">
						    <div class="card card--public card--item">
                                <img class="card-img-top" src="{{ url('img/cards/closets.jpg') }}" alt="closets-img" />
						        <div class="card-body">
    						        <h5 class="card-title">Colecciones</h5>
						            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
						            <a href="{{ url('closets') }}" class="btn btn-fr">Ver colecciones</a>
						        </div>
						    </div>
						</div>
						<div class="col-sm-6 mb-5">
						    <div class="card card--public card--item">
                                <img class="card-img-top" src="{{ url('img/cards/prendas.jpg') }}" alt="prendas-img" />
                                <div class="card-body">
                                    <h5 class="card-title">Prendas</h5>
                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    <a href="{{ url('items') }}" class="btn btn-fr">Ver prendas</a>
                                </div>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection
