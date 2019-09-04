@if(count($canceled) == 0)
	<p>No hemos encontrado ninguna venta cancelada.</p>
@else

	<p>Tienes {{ count($canceled) }} venta{{ count($canceled) > 1 ? 's' : '' }} cancelada{{ count($canceled) > 1 ? 's.' : '.' }}</p>

	<div class="card">
  		<ul class="list-group list-group-flush w-100">
			@foreach($canceled as $order)
	      		{{-- @foreach($items[$order->OrderID] as $item) --}}

	      			<li class="list-group-item">
				  		<div class="row no-gutters">
						    <div class="col-md-3">
						      <img src="{{ url('storage/'.$order->ThumbPath) }}" class="card-img" alt="{{ $order->ItemDescription }}">
						    </div>
						    <div class="col-md-6">
						      	<div class="card-body">
						      		<h5 class="card-title">{{ $order->ItemDescription }}</h5>
						      		<span class="badge badge-danger mb-3">{{ $order->Name }}</span>
						      	<p>
						      		<small>Talla: {{ $order->SizeID }}</small> <br>
						      		<small>Marca: {{ $order->BrandID }}</small>
						      	</p>
						      </div>
						    </div>
						    
						</div>
			  		</li>
	      		{{-- @endforeach --}}
      		@endforeach
		</ul>
	</div>			

@endif