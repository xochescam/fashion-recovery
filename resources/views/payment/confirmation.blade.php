@extends('dashboard.master')

@section('content')

	<main id="main">
      	<div class="container py-5">

		  	<div id="app">
			  	<shopping-steps-component
			  		step="4"
					urlone=""
					urltwo=""
					urlthree=""
					urlfour=""
				></shopping-steps-component>
			</div>

        	<h2 class="text-center TituloFR my-4 mb-5 ">¡Felicidades, tu compra ha sido procesada!</h2>

        	<p class="mb-5 text-left w-100">
				Este es el resumen de tu compra, en breve recibirás un correo con el resumen de tu compra y los datos necesarios para rastrear tu pedido. 
				Recuerda que siempre podrás ver el seguimiento en <a href="{{ url('orders') }}" class="green-link">Mis pedidos</a> dentro de tu cuenta.
			</p>

			<div class="w-100">
				@include('alerts.success')
				@include('alerts.warning')
			</div>

			<div class="row">
				<div class="col-md-9 order-sm-1 order-2">
					<div class="card mb-4">
						<div class="card-body row">
							<div class="col-md-6">

								<p>
									<b>Dirección de envío</b>
								</p>

								<p> <b>{{ count($items) }} producto{{ count($items) > 1 ? 's' : '' }} se enviar{{ count($items) > 1 ? 'án' : 'á' }} a {{ Auth::User()->Alias }} </b> en {{ $address->Street }} {{ $address->Suburb }} {{ $address->City }} {{ $address->ZipCode }} por parte de fashionrecovery.com</p>

							</div>
							<div class="col-md-6">
								<p>
									<b>Método de pago</b>
								</p>

								<p>xxxx xxxx xxxx x245 BBVA </p>
							</div>
						</div>
					</div>

					<div class="card">

		          		<ul class="list-group list-group-flush w-100">

			          		@foreach($items as $item)

			          			<li class="list-group-item">
							  		<div class="row no-gutters">
									    <div class="col-md-3">
									      <img src="{{ url('storage/'.$item->ThumbPath) }}" class="card-img" alt="{{ $item->BrandName }}">
									    </div>
									    <div class="col-md-9">
									      <div class="card-body">
									      	<div class="row">
												<p class="col-10">{{ $item->ItemDescription }}</p>
									      		<p class="font-weight-bold  text-right green-color p-0 col-2">{{ $item->ActualPrice }}</p>
									      	</div>
									      	<p>
									      		<small>Talla: {{ $item->SizeID }}</small> <br>
												<small>Marca: {{ $item->BrandID }}</small> <br>
												<small>Vendedor: {{ $item->Alias }}</small>
									      	</p>
									      </div>
									    </div>
									</div>
						  		</li>

			          		@endforeach
						</ul>
					</div>

					

				</div>

				<div class="col-md-3 order-sm-2 order-1">
					<div class="card bg-light fit-height mb-4">
						<div class="card-body w-full">
 							<h5 class="mb-2 text-center"><b>Gracias por tu compra</b></h5>

							<table class="w-100 mt-4">
								<tr>
									<td>Prendas:</td>
									<td class="text-right">${{ $items->first()->sub }}</td>
								</tr>
								<tr>
									<td>Envio:</td>
									<td class="text-right">$0</td>
								</tr>
							</table>
							<hr>

							<table class="w-100">
								<tr>
									<td class="text-right green-color">
										<h5><b>${{ $items->first()->sub }}</b></h5>
									</td>
								</tr>
							</table>

						</div>
					</div>

				</div>

			</div>

			<div class="w-100 text-center mt-3">
				<small>Al confirmar tu pedido, aceptas el <a class="green-link" href="{{ url('privacy') }}">Aviso de privacidad</a>, y los <a class="green-link" href="{{ url('terms') }}">Términos y condiciones</a>	 encontrados en fashionrecovery.com</small>					
			</div>
		</div>  
    </main>

@endsection
