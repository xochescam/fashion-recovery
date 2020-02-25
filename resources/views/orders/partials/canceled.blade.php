@if(count($canceled) == 0)
	<p>No hemos encontrado ningún pedido cancelado.</p>
@else

	<p>Tienes {{ count($canceled) }} pedido{{ count($canceled) > 1 ? 's' : '' }} cancelado{{ count($canceled) > 1 ? 's.' : '.' }}</p>

	<div class="card">
  		<ul class="list-group list-group-flush w-100">
			@foreach($canceled as $order)
	      		@foreach($items[$order->OrderID] as $item)

	      			<li class="list-group-item">
				  		<div class="row no-gutters">
						    <div class="col-md-3">
						      <img src="{{ url('storage/'.$item->ThumbPath) }}" class="card-img" alt="{{ $item->ItemDescription }}">
						    </div>
						    <div class="col-md-9">
						      	<div class="card-body">
						      		<h5 class="card-title">{{ $item->ItemDescription }}</h5>
						      		<span class="badge badge-danger mb-3">{{ $order->Name }}</span>
						      	<p>
						      		<small>Talla: {{ $item->SizeID }}</small> <br>
						      		<small>Marca: {{ $item->BrandID }}</small> <br>
									<small>Vendedor:  <a class="green-link" href="{{ url('seller/'.$item->Alias) }}">{{ $item->Alias }}</a></small>
						      	</p>
						      </div>
						    </div>
						</div>
			  		</li>
	      		@endforeach
      		@endforeach
		</ul>
	</div>			

@endif