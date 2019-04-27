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
	
			    <div class="row justify-content-around shadow-lg p-3 mb-5 bg-white rounded mx-md-5">
			      @foreach($items as $item)

			        <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
			          <div class="card card--public card--item shadow p-3 mb-5 bg-white rounded">
			            <img class="card-img-top" src="{{ url('storage',$item->ThumbPath) }}" alt="Card image cap" height="200px;">
			            <div class="card-body">
			              <div class="badges float-right">
			                <h5><span class="badge badge-pill badge-success">{{ $item->ActualPrice }} </span></h5>

							@if(isset($item->offer))
			                	<span class="badge badge-pill badge-danger">{{ $item->offer }}</span>
							@endif

			              </div>
			              <h4 class="card-title">{{ $item->BrandName }}</h4>
			              <h6>Falda</h6>

			              <p class="card-text" style="border-bottom: 1px solid gray; border-top: 1px solid gray;">
			                Talla: 5 <br />Color: {{ $item->ColorName }}</p>
			              <a href="#" class="btn btn-fr">Comprar</a>
			            </div>
			          </div>
			        </div>
			        
			      @endforeach

			    </div>
		  	</div>
		</section>
	</main>
@endsection
