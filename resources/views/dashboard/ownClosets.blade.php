@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
					<h2 class="left-center TituloFR my-4 mb-5 ">Hola {{ Auth::User()->Alias }}, este es tu Clóset</h2>

					<p class="mb-5">Dale un nuevo uso a tus prendas poniendolas disponibles para nuestras comunidad. Consulta aquí las prendas y colecciones que tienes disponibles en tu clóset.
					¡Cuidemos el planeta! Recuerda que la prenda más verde es aquella que ya existe. </p>

					<div class="float-right w-100">
						<div class="form-group row float-right">
							<label class="col-form-label mr-2">Pausar Clóset</label>
							<div class="col-form-label text-left d-flex align-top mr-3" id="app">
								<guardarropa-component
									initial="{{ Auth::User()->IsPaused }}"
									type="all"
									item="false"
								></guardarropa-component>
							</div>
						</div>
					</div>
					

					<div class="row">
						<div class="col-sm-6 mb-5 d-flex">
							<a href="{{ url('items') }}" class="a-card">
								<div class="card card--public card--item h-100">
									<img class="card-img-top" src="{{ url('img/cards/prendas.jpg') }}" alt="prendas-img" />
									<div class="card-body text-left">
										<h5 class="card-title">Prendas</h5>
										<p class="card-text">Revisa el detalle de las prendas que tienes disponibles para venta. </p>
									</div>
						    	</div>
							</a>
						</div>
						<div class="col-sm-6 mb-5 d-flex">
							<a href="{{ url('closets') }}" class="a-card">
								<div class="card card--public card--item h-100">
									<img class="card-img-top" src="{{ url('img/cards/closets.jpg') }}" alt="closets-img" />
									<div class="card-body text-left">
										<h5 class="card-title">Colecciones</h5>
										<p class="card-text">Arma listas de prendas de acuerdo a tus diferentes looks. Dale a tus compradores una herramienta más fácil de ver tu cloóset de manera ordenada y ganar seguidores. </p>
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
