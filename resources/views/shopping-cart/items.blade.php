@extends('dashboard.master')

@section('content')

	<main id="main">
      	<div class="container py-5">

			<shopping-steps-component
			  	step="1"
				urlone="{{ url('shopping-cart') }}"
				urltwo=""
				urlthree=""
				urlfour=""
			></shopping-steps-component>

        	<h2 class="text-center TituloFR my-4 mb-5">Carrito de compras</h2>

        	<p class="mb-5 text-left w-100">Este es el resumen de tu pedido. Al darle click en proceder el pago, 
			el proceso de compras te guiará seleccionando primero tu dirección de envío, después tu método de pago y 
			una vez confirmado el cargo un resumen de tu pedido y las indicaciones para consultar el estado de tu 
			envio. </p>

			<div class="w-100">
				<div class="alert alert-warning alert-dismissible d-none mb-3" role="alert">
					<span></span>
		<!-- 			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button> -->
				</div>

				<div class="alert alert-success alert-dismissible d-none mb-3" role="alert">
					<span></span>
<!-- 					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button> -->
				</div>
			</div>

			<item-list-component
				items="{{ $items }}"
				amount="{{ $total }}"
			 ></item-list-component>

      	</div>
    </main>

@endsection
