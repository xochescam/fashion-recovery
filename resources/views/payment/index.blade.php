@extends('dashboard.master')

@section('content')

<main>
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

		<payment-component
			amount="{{ isset($amount) ? $amount : '0' }}"
			:address="{{ json_encode($address) }}"
			:shippingcost="{{ $shippingCost }}"
			:subtotal="{{ $subtotal}}"
			:devtotal="{{ $devTotal }}"
			:total="{{ $total }}"
			csrf="{{ csrf_token() }}"
		>
		</payment-component>
    </div>
</main>


<!-- Modal -->
<div class="modal fade js-loader-payment" id="loader-payment" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">

		Estamos procesando tu compra

		<div class="d-flex justify-content-center mt-2">
			<span class="spinner-border spinner-border--green" role="status" aria-hidden="true"></span>
		</div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('mercadopago')
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
@endpush
