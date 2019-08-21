@extends('dashboard.master')

@section('content')

	 <main id="main">
      <div class="container py-5">
        <div class="row">
          	<h2 class="text-center TituloFR my-4 mb-5 w-100">Carrito</h2>

          	<p class="text-center mb-5 w-100">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit qui ad, commodi nostrum repudiandae ipsam soluta excepturi.</p>

          	@include('alerts.success')
  			@include('alerts.warning')

          	<p class="font-weight-bold w-100 text-right px-4">Precio</p>

          	<ul class="list-group list-group-flush w-100">
			  	<li class="list-group-item">
			  		<div class="row no-gutters">
					    <div class="col-md-3">
					      <img src="{{ url($item->ThumbPath) }}" class="card-img" alt="...">
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

					        <p class="card-text"><small class="text-muted"><a href="#" class="text-danger">Eliminar</a></small></p>
					      </div>
					    </div>
					 </div>
			  	</li>
			</ul>
			<p class="w-100 text-right px-4 mt-3">Subtotal (1 producto): <span class="font-weight-bold green-color">${{ $item->ActualPrice }}</span></p>

        </div>
      </div>
    </main>
@endsection
