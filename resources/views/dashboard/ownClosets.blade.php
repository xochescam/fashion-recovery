@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
					<h2 class="left-center TituloFR my-4 mb-5 ">Hola {{ Auth::User()->Alias }}, este es tu Guardarropa.</h2>

					<p class="mb-5">Conviertete socialmente responsable cuidando al planeta a través de las prendas verdes. </p>

					<div class="float-right w-100">
						<div class="form-group row float-right">
							<label class="col-form-label mr-2">Pausar Guardarropa</label>
							<div class="col-form-label text-left d-flex align-top mr-3" id="app">
								<guardarropa-component
									initial="{{ Auth::User()->IsPaused }}"
									type="all"
								></guardarropa-component>
							</div>
						</div>
					</div>
					

					<div class="row">
						<div class="col-sm-6 mb-5">
							<a href="{{ url('items') }}" class="a-card">
								<div class="card card--public card--item">
									<img class="card-img-top" src="{{ url('img/cards/prendas.jpg') }}" alt="prendas-img" />
									<div class="card-body text-left">
										<h5 class="card-title">Prendas</h5>
										<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
									</div>
						    	</div>
							</a>
						</div>
						<div class="col-sm-6 mb-5">
							<a href="{{ url('closets') }}" class="a-card">
								<div class="card card--public card--item">
									<img class="card-img-top" src="{{ url('img/cards/closets.jpg') }}" alt="closets-img" />
									<div class="card-body text-left">
										<h5 class="card-title">Colecciones</h5>
										<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection
