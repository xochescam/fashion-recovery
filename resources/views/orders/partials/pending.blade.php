@if(count($pending) == 0)
	<p>¿Buscas un pedido? Se han enviado todos los pedidos.</p>
@else
	<p>Tienes {{ count($pending) }} pedido{{ count($pending) > 1 ? 's' : '' }} realizado{{ count($pending) > 1 ? 's.' : '.' }}</p>

	<div class="card">
  		<ul class="list-group list-group-flush w-100">
			@foreach($pending as $order)
          		@foreach($items[$order->OrderID] as $item)

				  @include('orders.partials.item')

          		@endforeach
          	@endforeach
		</ul>
	</div>	
			
@endif