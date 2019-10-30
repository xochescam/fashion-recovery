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

			<div class="accordion col-md-8 m-auto" id="accordionExample">
				<div class="card">
					<div class="card-header" id="headingOne">
					<h2 class="mb-0">
						<button class="btn green-link btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
						<i class="fab fa-cc-visa"></i>
						Pago con tarjetas de Crédito y Débito
						</button>
					</h2>
					</div>

					<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
						<div class="card-body">
							@include('payment.card')				
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingTwo">
					<h2 class="mb-0">
						<button class="btn green-link btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						<i class="fab fa-cc-paypal"></i>
						PayPal	
						</button>
					</h2>
					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
					<div class="card-body text-center">
						<p class="mb-3">Para pagar con Paypal te dirigiremos a su sitio.</p>
						
						<a href="https://www.paypal.com/mx/signin" class="btn btn-fr btn-block w-25 m-auto">
							<span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
							Ir
						</a>

					</div>
					</div>
				</div>


			<div class="row mt-4">
				<a href="{{ url('summary',$address->ShippingAddID) }}" class="btn btn-fr m-auto">Continuar</a>
			</div>
      </div>
    </main>

@endsection
