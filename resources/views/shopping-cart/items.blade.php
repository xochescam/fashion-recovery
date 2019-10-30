@extends('dashboard.master')

@section('content')

	<main id="main">
      	<div class="container py-5">
        	<h2 class="text-center TituloFR my-4 mb-5 ">Carrito de compras</h2>

        	<p class="mb-5 text-center w-100">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit qui ad, commodi nostrum repudiandae ipsam soluta excepturi.</p>

			<div class="w-100">
				@include('alerts.success')
				@include('alerts.warning')
			</div>

			<div class="row">
				<div class=" {{ count($items) > 0 ? 'col-md-9 mb-4' : 'w-100' }}">
		  			@if(count($items) > 0)

		          		<p class="font-weight-bold w-100 text-right px-4">Precio</p>

		          		<ul class="list-group list-group-flush w-100">

			          		@foreach($items as $item)

			          			<li class="list-group-item">
							  		<div class="row no-gutters">
									    <div class="col-md-3">
									      <img src="{{ url('storage/'.$item->ThumbPath) }}" class="card-img" alt="{{ $item->ItemDescription }}">
									    </div>
									    <div class="col-md-9">
									      <div class="card-body">
									      	<div class="row">
									      		<h5 class="card-title col-10">{{ $item->ItemDescription }}</h5>
									      		<p class="font-weight-bold  text-right green-color p-0 col-2">{{ $item->ActualPrice }}</p>
									      	</div>
									      	<p>
									      		<small>Talla: {{ $item->SizeID }}</small> <br>
									      		<small>Marca: {{ $item->BrandID }}</small>
									      	</p>

									        <p class="card-text"><small class="text-muted"><a href="{{ url('delete-to-cart/'.$item->ShoppingCartID.'/cart') }}" class="text-danger">Eliminar</a></small></p>
									      </div>
									    </div>
									</div>
						  		</li>

			          		@endforeach
						</ul>

						<p class="w-100 text-right px-4 mt-3">Subtotal ({{ count($items) }} producto{{ count($items) > 1 ? 's' : '' }}): 
						<span class="font-weight-bold green-color">${{ $items->first()->sub }} </span></p>
					@else

						<p class="text-center green-color">No tienes productos en el carrito.</p>
		          	@endif				
				</div>

				@if(count($items) > 0)
					<div class="col-md-3">
						<div class="card bg-light fit-height">
							<div class="card-body w-full">
								<h5 class="card-title"><b>Resumen del pedido</b></h5>

								<table class="w-100 mt-4">
									<tr>
										<td>Subtotal:</td>
										<td class="text-right">${{ $items->first()->sub }}</td>
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
											<h5><b>${{ $items->first()->sub }}</b></h5>
										</td>
									</tr>
								</table>

								<a href="{{ url('address') }}" class="btn btn-fr w-100 mt-2">Proceder al pago</a>
							</div>							
						</div>

					</div>
				@endif

			</div>
      </div>
    </main>

@endsection
