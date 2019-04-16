@extends('dashboard.master')

@section('content')

	 <main id="main">
	    <div class="container py-5">
	      	<div class="row">
	        	<div class="col-12">

					@if(Auth::User()->isSellerProfile())

						<div class="row">
						  <div class="col-sm-6">
						    <div class="card">
						      <div class="card-body">
						        <h5 class="card-title">Closets</h5>
						        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
						        <a href="{{ url('closets') }}" class="btn btn-fr">Ver</a>
						      </div>
						    </div>
						  </div>
						  <div class="col-sm-6">
						    <div class="card">
						      <div class="card-body">
						        <h5 class="card-title">Prendas</h5>
						        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
						        <a href="{{ url('items') }}" class="btn btn-fr">Ver</a>
						      </div>
						    </div>
						  </div>
						</div>

					@else

						<h4 class="mb-5">Hola, {{ isset(Auth::User()->Name) ? Auth::User()->Name : Auth::User()->Alias }}</h4>

						@include('alerts.success')
              			@include('alerts.warning')

						@if(!Auth::User()->Confirmed)

							<div class="alert alert-warning w-50" role="alert">
							  Recuerda confirmar tu cuenta <a href="{{ url('resend-confirm-account',Auth::User()->id) }}" class="alert-link">reenviar enlace</a>. Give it a click if you like.
							</div>
						@endif

					@endif

				</div>
			</div>
		</div>
	</main>
@endsection
