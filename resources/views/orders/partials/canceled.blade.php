@if(count($canceled) == 0)
	<p>No hemos encontrado ningún pedido cancelado.</p>
@else

	<p>Tienes {{ count($canceled) }} pedido{{ count($canceled) > 1 ? 's' : '' }} cancelado{{ count($canceled) > 1 ? 's.' : '.' }}</p>

	<div class="card">
  		<ul class="list-group list-group-flush w-100">
			@foreach($canceled as $item)

				  @include('orders.partials.item')
				  
      		@endforeach
		</ul>
	</div>			

@endif