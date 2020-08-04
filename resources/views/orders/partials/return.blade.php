@if(count($return) == 0)
	<p>¿Buscas un pedido? Se han enviado todos los pedidos.</p>
@else
	<p>Tienes {{ count($return) }} pedido{{ count($return) > 1 ? 's' : '' }} realizado{{ count($return) > 1 ? 's.' : '.' }}</p>

	<div class="card">
  		<ul class="list-group list-group-flush w-100">
			@foreach($return as $item)

				  @include('orders.partials.item')

          	@endforeach
		</ul>
	</div>	
			
@endif