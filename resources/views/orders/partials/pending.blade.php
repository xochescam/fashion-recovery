@if(count($pending) == 0)
	<p>¿Buscas un pedido? Se han enviado todos los pedidos.</p>
@else
	<p>Tienes {{ count($pending) }} pedido{{ count($pending) > 1 ? 's' : '' }} realizado{{ count($pending) > 1 ? 's.' : '.' }}</p>

	@foreach($pending as $order)

		<div class="card">
      		<ul class="list-group list-group-flush w-100">

          		@foreach($items[$order->OrderID] as $item)

          			<li class="list-group-item">
				  		<div class="row no-gutters">
						    <div class="col-md-3">
						      <img src="{{ url('storage/'.$item->ThumbPath) }}" class="card-img" alt="{{ $item->ItemDescription }}">
						    </div>
						    <div class="col-md-9">
						      	<div class="card-body">
						      		<h5 class="card-title">{{ $item->ItemDescription }}</h5>
						      		<span class="badge badge-warning mb-3">{{ $order->Name }}</span>
						      	<p>
						      		<small>Talla: {{ $item->SizeID }}</small> <br>
						      		<small>Marca: {{ $item->BrandID }}</small>
						      	</p>
						      </div>
						    </div>
						</div>
			  		</li>

          		@endforeach
			</ul>

		</div>			

	@endforeach
@endif