@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">
					<h2 class="left-center TituloFR my-4 mb-5 ">Hola {{ Auth::User()->Alias }}, este es tu Clóset</h2>

					<p class="mb-5">
						!Dale un nuevo uso a tus prendas! Nuestra comunidad puede estar interesada en tus piezas. En tu Clóset, puedes consultas las prendas y colecciones que tienes disponibles para venta.¡Únete al movimiento y cuidemos juntos al planeta! Recuerda que la prenda más verde, es la que ya existe.
					</p>

					<div class="float-right w-100">
						<div class="form-group row float-right">
							<label class="col-form-label mr-2">Pausar Clóset</label>
							<div class="col-form-label text-left d-flex align-top mr-3">
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

							<div class="card card--public card--item h-100 m-auto">
								<a href="{{ url('items') }}" class="a-card">
									<div id="carouselItems" class="carousel slide" data-ride="carousel">
										<div class="carousel-inner">
											@foreach($items as $item)
												<div class="carousel-item {{ $item->ThumbPath == $items->first()->ThumbPath ? 'active' : ''  }}">
													<img src="{{ url('storage/'.$item->ThumbPath) }}" class="d-block w-100">
												</div>
											@endforeach
										</div>
										<button class="carousel-control-prev" href="#carouselItems" role="button" data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Anterior</span>
										</button>
										<button class="carousel-control-next" href="#carouselItems" role="button" data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Siguiente</span>
										</button>
									</div>

									<div class="card-body text-left">
										<h5 class="card-title">Prendas</h5>
										<p class="card-text">Revisa el detalle de las prendas que tienes disponibles para venta. </p>
									</div>
								</a>
						    </div>
						</div>


						<div class="col-sm-6 mb-5 d-flex">
							<div class="card card--public card--item h-100 m-auto">
								<a href="{{ url('closets') }}" class="a-card">
									<div id="carouselCollections" class="carousel slide" data-ride="carousel">
										<div class="carousel-inner">
											@foreach($closets as $closet)
												<div class="carousel-item {{ $closet->ThumbPath == $closets->first()->ThumbPath ? 'active' : ''  }}">
													<img src="{{ url('storage/'.$closet->ThumbPath) }}" class="d-block w-100" >
												</div>
											@endforeach
										</div>
										<button class="carousel-control-prev" href="#carouselCollections" role="button" data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Anterior</span>
										</button>
										<button class="carousel-control-next" href="#carouselCollections" role="button" data-slide="next">
											<span class="carousel-control-next-icon" aria-hidden="true"></span>
											<span class="sr-only">Siguiente</span>
										</button>
									</div>
									<div class="card-body text-left">
										<h5 class="card-title">Colecciones</h5>
										<p class="card-text">Arma listas de prendas de acuerdo a tus diferentes looks. Dale a tus compradores una herramienta más fácil de ver tu cloóset de manera ordenada y ganar seguidores. </p>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection
