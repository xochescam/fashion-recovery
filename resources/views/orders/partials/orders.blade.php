@if(count($orders) == 0)
	<p>No tienes pedidos realizados.</p>
@else

	<p>Tienes {{ count($orders) }} pedido{{ count($orders) > 1 ? 's' : '' }} realizado{{ count($orders) > 1 ? 's.' : '.' }}</p>

	<div class="card">
  		<ul class="list-group list-group-flush w-100">
			@foreach($orders as $order)
	      		@foreach($items[$order->OrderID] as $item)

	      			@include('orders.partials.item')

	      		@endforeach
      		@endforeach
		</ul>
	</div>	
			
@endif