@if(count($finalized) == 0)
	<p>Ha finalizado el curso de todos tus pedidos.</p>
@else
	
	<p>Tienes {{ count($finalized) }} pedido{{ count($finalized) > 1 ? 's' : '' }} finalizado{{ count($finalized) > 1 ? 's.' : '.' }}</p>

	<div class="card">
  		<ul class="list-group list-group-flush w-100">
			@foreach($finalized as $item)

				  @include('orders.partials.item')

      		@endforeach
		</ul>
	</div>	
	
@endif
