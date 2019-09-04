@if(count($finalized) == 0)
	<p>Ha finalizado el curso de todas tus ventas.</p>
@else
	
	<p>Tienes {{ count($finalized) }} venta{{ count($finalized) > 1 ? 's' : '' }} finalizada{{ count($finalized) > 1 ? 's.' : '.' }}</p>

	<div class="card">
  		<ul class="list-group list-group-flush w-100">
			@foreach($finalized as $order)
	      		{{-- @foreach($items[$order->OrderID] as $item) --}}

	      			<li class="list-group-item">
				  		<div class="row no-gutters">
						    <div class="col-md-3">
						      <img src="{{ url('storage/'.$order->ThumbPath) }}" class="card-img" alt="{{ $order->ItemDescription }}">
						    </div>
						    <div class="col-md-9">
						      	<div class="card-body">
						      		<h5 class="card-title">{{ $order->ItemDescription }}</h5>
						      		<span class="badge badge-success mb-3">{{ $order->Name }}</span>
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
