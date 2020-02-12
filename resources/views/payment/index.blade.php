@extends('dashboard.master')

@section('content')

<main id="app">
    <div class="container py-5">

		<div>
			<shopping-steps-component
			  	step="3"
				urlone="{{ url('shopping-cart') }}"
				urltwo="{{ url('address') }}"
				urlthree="{{ url('/payment/'.$ShippingAddID.'/'.$IsBuy) }}"
				urlfour=""
			></shopping-steps-component>
		</div>

        <h2 class="text-center TituloFR my-4 mb-5 ">¡Ya casi esta listo tu pedido!</h2>

        <p class="mb-5 text-left w-100">
			Elige tú método de pago e ingresa los datos necesarios. Una vez hecho el cargo podrás 
			visualizar el resumen de tu pedido y las indicaciones para consultar el estado de tu envio.
		</p>

		<div class="w-100">
			@include('alerts.success')
			@include('alerts.warning')
		</div>

		<div class="row">
			<div class="col-md-9 order-2 order-md-1 mb-4">
				<div class="accordion" id="accordionExample">
					<div class="card">
						<div class="card-header p-0" id="headingOne">
							<a class="btn green-link w-100 p-3 d-flex justify-content-start align-items-center" type="button" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
								<img src="{{ url('/img/logos/credit.png') }}" class="mr-1 height-15" alt="">
								<span>Tarjetas de Crédito y Débito</span>	
							</a>
						</div>

						<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
							<div class="card-body">
								@include('payment.card')				
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header p-0" id="headingTwo">
							<a class="btn green-link w-100 p-3 d-flex justify-content-start align-items-center" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-controls="collapseTwo">
								<img src="{{ url('/img/logos/paypal-logo.png') }}" class="mr-1 height-15" alt="">
								<span>PayPal</span>	
							</a>
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
				</div>					
		</div>
		<div class="col-md-3 order-1 order-md-2 mb-4">
			<div class="card bg-light fit-height">
				<div class="card-body w-full">
					<h5 class="card-title"><b>Resumen del pedido</b></h5>

					<table class="w-100 mt-4">
						<tr>
							<td>Subtotal:</td>
							<td class="text-right">$ {{ Auth::User()->getTotal() }} </td>
						</tr>
						<tr>
							<td>Envio:</td>
							<td class="text-right">$0</td>
						</tr>
					</table>
					<hr>

					<table class="w-100 mt-4">
						<tr>
							<td>Total:</td>
							<td class="text-right green-color">
								<h5><b>$ {{ Auth::User()->getTotal() }}</b></h5>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>	
    </div>

	<div class="row mt-4">
		<a href="{{ url('summary',$address->ShippingAddID) }}" class="btn btn-fr m-auto">Pagar</a>		


<!-- 
		<confirm-buy
			shipping="{{ $address->ShippingAddID }}"
			shipping="{{ $address->ShippingAddID }}"
		></confirm-buy> -->
	</div>	
</main>

@endsection
