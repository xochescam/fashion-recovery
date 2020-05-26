@extends('dashboard.master')

@section('content')

	<main>
      	<div class="container py-5" >
			
		  <div>
			<shopping-steps-component
			  	step="2"
				urlone="{{ url('shopping-cart') }}"
				urltwo="{{ url('address') }}"
				urlthree=""
				urlfour=""
			></shopping-steps-component>
		</div>
		 	

        	<h2 class="text-center TituloFR my-4 mb-5 ">¿A dónde lo enviaremos?</h2>

        	<p class="mb-5 text-left w-100">
				Elige la dirección en donde quieres recibir tu pedido. Si quieres enviarlo a otra dirección da click en el botón Nueva dirección.
			</p>

			<div class="w-100">
				@include('alerts.success')
				@include('alerts.warning')
			</div>

			<div class="row">

				<div class="order-2 order-md-1 col-md-9 mb-4">
					@foreach($addresses as $address)
						<div class="card mb-4 mr-md-4 w-100">
							<div class="card-body">
							    <h5 class="card-title">{{ $address->Alias }} </h5>

							    <p class="card-text">{{ $address->Street }} {{ $address->Suburb }} {{ $address->City }} {{ $address->ZipCode }}</p>

							    <a data-toggle="modal" data-target="#address-{{ $address->ShippingAddID }}" class="btn btn-outline-green mb-2 btn-sm">
									Editar
								</a>
							    <a href="{{ url('payment/'.$address->ShippingAddID.'/false') }}" class="btn btn-fr btn-sm mb-2">
									Elegir y continuar
								</a>
							</div>
						</div>
					@endforeach
				</div>
				<div class="col-md-3 order-1 order-md-2 mb-4">
					<div class="card bg-light fit-height">
						<div class="card-body w-full">
							<h5 class="card-title"><b>Resumen del pedido</b></h5>

							<table class="w-100 mt-4">
								<tr>
									<td>Subtotal:</td>
									<td class="text-right">{{ Auth::User()->getTotal() }} </td>
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
									<h5><b>{{ Auth::User()->getTotal() }}</b></h5>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>

      	</div>
   

	@foreach($addresses as $address)

		<!-- Modal -->
		<div class="modal fade" id="address-{{ $address->ShippingAddID }}" tabindex="-1" role="dialog" aria-labelledby="addressLabel{{ $address->ShippingAddID }}" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addressLabel-{{ $address->ShippingAddID }}">Editar dirección</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<form method="POST"action="{{ url('shipping',$isNew ? '' : $address->ShippingAddID)  }}" class="needs-validation" novalidate>
						{!! csrf_field() !!}

						<input type="hidden" value="{{ $type_url }}" name="type_url">

						<address-form
							:states="{{ json_encode($states) }}"
							:errors="{{ count($errors) > 0 ? $errors : '{}'  }}"
							:old="{{ count(Session::getOldInput()) > 0 ? json_encode(Session::getOldInput()) : '{}'}}"
							:address="{{ $isNew ? '{}' : json_encode($address) }}"
						>
						</address-form>

						<div class="w-auto text-center">
						<button class="btn btn-fr w-50">
							<span class="spinner-border spinner-border-sm hidden" role="status" aria-hidden="true"></span>
							Guardar
						</button>
						</div>
					</form>

					
				</div>

				
			</div>
		</div>

	@endforeach
	</main>
@endsection
