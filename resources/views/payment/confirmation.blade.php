@extends('dashboard.master')

@section('content')

	<main id="main">
      	<div class="container py-5">
        	<h2 class="text-center TituloFR my-4 mb-5 ">Revisar tu pedido</h2>

        	<p class="mb-5 text-center w-100">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit qui ad, commodi nostrum repudiandae ipsam soluta excepturi.</p>

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
									<small><a href="{{ url('address/'.$address->ShippingAddID.'/confirmation') }}" class="green-link">Editar</a></small>
								</p>

								<p> {{ $address->Street }} {{ $address->Suburb }} {{ $address->City }} {{ $address->ZipCode }}</p>

							</div>
							<div class="col-md-6">
								<p>
									<b>Método de pago</b>
									<small><a href="#" class="green-link">Editar</a></small>
								</p>

								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam.</p>
							</div>
						</div>
					</div>

					<div class="card">

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
									      		<p class="font-weight-bold  text-right green-color p-0 col-2">${{ $item->ActualPrice }}</p>
									      	</div>
									      	<p>
									      		<small>Talla: {{ $item->SizeID }}</small> <br>
									      		<small>Marca: {{ $item->BrandID }}</small>
									      	</p>

									        <p class="card-text"><small class="text-muted"><a href="{{ url('delete-to-cart',$item->ShoppingCartID) }}" class="text-danger">Eliminar</a></small></p>
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
							<a href="{{ url('confirmation/'.$address->ShippingAddID) }}" class="btn btn-fr btn-lg w-100 mb-4">Comprar ahora</a>

							<p class="m-0"><b>Confirmación del pedido</b></p>

							<table class="w-100">
								<tr>
									<td>Productos:</td>
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
									<td class="text-left green-color">
										<h5><b>Importe total:</b></h5>
									</td>
									<td class="text-right green-color">
										<h5><b>${{ $items->first()->sub }}</b></h5>
									</td>
								</tr>
							</table>

						</div>
					</div>

				</div>

			</div>
      	</div>
    </main>

@endsection
